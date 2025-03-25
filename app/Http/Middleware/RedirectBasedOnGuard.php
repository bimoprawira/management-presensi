<?php

// app/Http/Middleware/RedirectBasedOnGuard.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnGuard
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard('hr')->check()) {
            return redirect()->route('hr.dashboard');
        }

        if (Auth::guard('web')->check()) {
            return redirect()->route('karyawan.dashboard');
        }

        return $next($request);
    }
}
