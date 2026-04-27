<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// --- Guest routes ---
Route::middleware('guest')->group(function () {
    Route::get('/register',            [RegisterController::class,      'show'])->name('register');
    Route::post('/register',           [RegisterController::class,      'store']);

    Route::get('/login',               [LoginController::class,         'show'])->name('login');
    Route::post('/login',              [LoginController::class,         'store']);

    Route::get('/forgot-password',     [PasswordResetController::class, 'requestForm'])->name('password.request');
    Route::post('/forgot-password',    [PasswordResetController::class, 'sendLink'])->name('password.email');

    Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
    Route::post('/reset-password',        [PasswordResetController::class, 'reset'])->name('password.update');
});

// --- Authenticated routes ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Email verification
    Route::get('/email/verify',                  [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}',      [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('signed');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])->name('verification.send')->middleware('throttle:6,1');

    // Pending verification holding page (no org-verified check)
    Route::get('/pending', [DashboardController::class, 'pending'])->name('pending');

    // Main dashboard — requires verified organisation
    Route::middleware('org.verified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});

Route::get('/', fn () => redirect()->route('login'));
