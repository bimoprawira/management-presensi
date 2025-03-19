<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|min:5|max:255'
        ]);

        // Hash the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // Flash a success message to the session
        $request->session();
        return redirect('/login')->with('success', 'Registrasi berhasil! Silahkan login');
    }
}
