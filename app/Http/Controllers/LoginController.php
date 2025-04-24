<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }
    /**
     * Handle an authentication attempt.
     */
    // app/Http/Controllers/LoginController.php

    // app/Http/Controllers/LoginController.php
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'], // Field 'login' bisa berisi email atau username
            'password' => ['required'],
        ]);
    
        // Cek apakah input adalah email atau username
        $loginType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
    
        // Gabungkan credentials untuk attempt
        $authCredentials = [
            $loginType => $credentials['login'],
            'password' => $credentials['password'],
        ];
    
        if (Auth::attempt($authCredentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
    
        return back()->withErrors([
            'login' => 'Email atau Password salah', // Pesan error
        ]);
    }
    
}
