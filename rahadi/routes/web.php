<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Group routes untuk tamu (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
    Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
});

// Group routes untuk yang sudah login dan role admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/siswa', SiswaController::class);
    Route::resource('/admin/akun', LoginRegisterController::class);
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
});

// Rute untuk Dashboard (user yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
