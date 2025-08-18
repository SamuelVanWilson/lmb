<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\AdminController; // Pastikan Anda mengimpor ini

Route::middleware(['redirectifadmin'])->group(function () {
    // == RUTE PUBLIK ==
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/destinations', [HomeController::class, 'destination'])->name('destination');
    Route::get('/destinations/{destination:name}', [HomeController::class, 'show'])->name('destinations.show');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [UserController::class, 'index'])->name('profile');
        Route::post('/transactions/{destination:name}', [HomeController::class, 'store'])->name('transactions.store');
    });

    // == RUTE AUTENTIKASI (Hanya untuk tamu) ==
    Route::middleware('guest')->group(function () {
        Route::get('register', [AuthController::class, 'halamanRegister'])->name('register');
        Route::post('register', [AuthController::class, 'register'])->name('register.post');
        Route::get('login', [AuthController::class, 'halamanLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');
    });
});

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['admin', 'auth'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('transactions');
    Route::resource('destinations', DestinationController::class);
});
