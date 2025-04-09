<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase() // Memerlukan huruf besar dan kecil
                    ->symbols()    // Memerlukan minimal 1 simbol
            ],
        ]);

        // Hash the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'user';

        User::create($validatedData);

        // Flash a success message to the session
        $request->session();
        return redirect('/login')->with('success', 'Registrasi berhasil! Silahkan login');
    }
}
