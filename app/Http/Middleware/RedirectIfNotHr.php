<?php

// app/Http/Middleware/RedirectIfNotHr.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotHr
{
    public function handle(Request $request, Closure $next, $guard = 'hr')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('hr.login');
        }

        return $next($request);
    }
}