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
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard'); // Pastikan redirect ke dashboard
    }

    return back()->withErrors([
        'email' => 'Email atau password salah',
    ]);
}
    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('dashboard');
    }
}
