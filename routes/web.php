<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('home'); // Selalu tampilkan halaman home, baik sudah login atau belum
})->name('home');

// Login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
// Register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
