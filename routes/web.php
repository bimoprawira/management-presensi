<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\HrAuthController;
use App\Http\Controllers\Hr\DashboardController as HrDashboardController;
use App\Http\Controllers\Hr\KaryawanController as HrKaryawanController;
use App\Http\Controllers\Hr\PresensiController as HrPresensiController;
use App\Http\Controllers\Hr\CutiController as HrCutiController;
use App\Http\Controllers\Hr\GajiController as HrGajiController;
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\Karyawan\PresensiController as KaryawanPresensiController;
use App\Http\Controllers\Karyawan\CutiController as KaryawanCutiController;
use App\Http\Controllers\Karyawan\GajiController as KaryawanGajiController;

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

// Karyawan Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Karyawan Dashboard (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard-karyawan', [KaryawanDashboardController::class, 'index'])
        ->name('karyawan.dashboard');

    // Group karyawan resources with consistent naming
    Route::prefix('karyawan')->group(function () {
        Route::resource('presensi', KaryawanPresensiController::class)
            ->only(['index', 'create', 'store'])
            ->names('karyawan.presensi');

        Route::resource('cuti', KaryawanCutiController::class)
            ->only(['index', 'create', 'store'])
            ->names('karyawan.cuti');

        Route::get('gaji', [KaryawanGajiController::class, 'index'])
            ->name('karyawan.gaji.index');
    });
});

// HR Auth Routes
Route::prefix('hr')->group(function () {
    Route::middleware('guest:hr')->group(function () {
        Route::get('/login', [HrAuthController::class, 'showLoginForm'])
            ->name('hr.login');
        Route::post('/login', [HrAuthController::class, 'login']);
    });

    Route::post('/logout', [HrAuthController::class, 'logout'])
        ->name('hr.logout')
        ->middleware('auth:hr');
});

// HR Dashboard (Protected)
Route::prefix('hr')->middleware(['auth:hr', 'verified'])->group(function () {
    Route::get('/dashboard', [HrDashboardController::class, 'index'])
        ->name('hr.dashboard');

    // Karyawan Management
    Route::resource('karyawan', HrKaryawanController::class)
        ->names('hr.karyawan');

    // Presensi Management
    Route::resource('presensi', HrPresensiController::class)
        ->names('hr.presensi');

    // Cuti Management
    Route::get('cuti', [HrCutiController::class, 'index'])
        ->name('hr.cuti.index');
    Route::post('cuti/{cuti}/approve', [HrCutiController::class, 'approve'])
        ->name('hr.cuti.approve');
    Route::post('cuti/{cuti}/reject', [HrCutiController::class, 'reject'])
        ->name('hr.cuti.reject');

    // Gaji Management
    Route::resource('gaji', HrGajiController::class)
        ->names('hr.gaji');
});
