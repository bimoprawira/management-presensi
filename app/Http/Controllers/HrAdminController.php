<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\HrAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HrAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('hr.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('hr')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('hr/dashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('hr')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/hr/login');
    }
}