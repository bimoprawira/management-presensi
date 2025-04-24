<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DataKaryawanController;

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


// Dashboard (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //presensi
    Route::get('/presensi', [PresensiController::class, 'form'])->name('presensi.form');
    Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');
    Route::get('/presensi/test-database', [PresensiController::class, 'testDatabase']);
    //log presensi
    Route::get('/log-presensi', [PresensiController::class, 'log'])->name('log-presensi');
    Route::get('/log-presensi', [PresensiController::class, 'logPresensi'])->name('log-presensi');

    // Tidak ada route konfigurasi di sini

    Route::get('/datakaryawan', [DataKaryawanController::class, 'index'])
    ->name('datakaryawan');

    Route::get('/cutikaryawan', function () {
        return view('admin.cutikaryawan');
    })->name('cutikaryawan');

});

// // Admin admin aja
// Route::get('/datakaryawan', function () {
//     return view('admin.datakaryawan');
// })->name('datakaryawan')->middleware(['auth', 'admin']);