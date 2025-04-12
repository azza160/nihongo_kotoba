<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



// proses login & register & logout

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest')  // Menambahkan middleware guest di sini
    ->name('login');


Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Dashboard Admin (khusus admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
    // Tambahkan route admin lainnya di sini
});





// Dashboard Pengguna (khusus pengguna)
Route::middleware(['auth', 'role:pengguna'])->group(function () {
    Route::get('/pengguna/dashboard', function () {
        return view('pengguna.dashboard.dashboard');
    })->name('pengguna.dashboard');
    // Route pengguna lainnya
});
