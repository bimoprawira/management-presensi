<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:karyawan',
            'password' => 'required|min:5|confirmed',
            'jabatan' => 'required',
            'tanggal_bergabung' => 'required|date'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Karyawan::create($validatedData);

        return redirect('/login')->with('success', 'Registration successful! Please login');
    }
}