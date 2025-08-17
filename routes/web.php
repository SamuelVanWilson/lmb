<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController; // Pastikan Anda mengimpor ini

// Rute Halaman Utama
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/destinasi', function () {
    return view('home');
})->name('destinasi');
Route::get('/profile', function () {
    return view('home');
})->name('profile');

// Grup Rute untuk Tamu (yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'halamanRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');
    Route::get('login', [AuthController::class, 'halamanLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

// Grup Rute untuk User yang sudah Terautentikasi
Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Grup Rute Khusus Admin
    // Pastikan middleware 'admin' sudah dibuat dan didaftarkan di app/Http/Kernel.php
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function() {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        // Tambahkan rute admin lainnya di sini (misal: CRUD)
    });
});
