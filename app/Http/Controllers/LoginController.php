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
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('home');
        }
 
        return back()->with('loginError', 'Login gagal!');
    }
}