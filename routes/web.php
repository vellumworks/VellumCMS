<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Settings\OrgSettingsController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

// --- Guest routes ---
Route::middleware('guest')->group(function () {
    // Combined get-started page (register + login tabs)
    Route::get('/get-started', fn () => view('auth.get-started'))->name('get-started');
    Route::get('/register',    fn () => redirect()->route('get-started'))->name('register');
    Route::post('/register',   [RegisterController::class, 'store']);

    Route::get('/login',       fn () => redirect()->to('/get-started?tab=login'))->name('login');
    Route::post('/login',      [LoginController::class, 'store']);

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

    // Main dashboard + all protected pages — requires verified organisation
    Route::middleware('org.verified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Settings
        Route::get('/settings/organisation',    [OrgSettingsController::class, 'show'])->name('settings.organisation');
        Route::patch('/settings/organisation',  [OrgSettingsController::class, 'update'])->name('settings.organisation.update');

        Route::get('/settings/profile',         [ProfileController::class, 'show'])->name('settings.profile');
        Route::patch('/settings/profile',       [ProfileController::class, 'update'])->name('settings.profile.update');
        Route::patch('/settings/password',      [ProfileController::class, 'updatePassword'])->name('settings.password');

        // Team
        Route::get('/team',                     [TeamController::class, 'index'])->name('team.index');
        Route::post('/team/invite',             [TeamController::class, 'invite'])->name('team.invite');
        Route::patch('/team/{user}/role',       [TeamController::class, 'updateRole'])->name('team.role');
        Route::delete('/team/{user}',           [TeamController::class, 'remove'])->name('team.remove');
    });
});

// Invitation (public — no auth needed)
Route::get('/invitation/{token}',  [InvitationController::class, 'show'])->name('invitation.show');
Route::post('/invitation/{token}', [InvitationController::class, 'accept'])->name('invitation.accept');

// --- Public website ---
Route::get('/',              [PublicController::class, 'home'])->name('home');
Route::get('/about',         [PublicController::class, 'about'])->name('about');
Route::get('/features',      [PublicController::class, 'features'])->name('features');
Route::get('/no-costs',      [PublicController::class, 'noCosts'])->name('no-costs');
Route::get('/how-it-works',  [PublicController::class, 'howItWorks'])->name('how-it-works');
Route::get('/faqs',          [PublicController::class, 'faqs'])->name('faqs');
Route::get('/contact',       [PublicController::class, 'contact'])->name('contact');
Route::get('/roadmap',       [PublicController::class, 'roadmap'])->name('roadmap');
Route::get('/legal',         [PublicController::class, 'legal'])->name('legal');
Route::get('/legal/privacy-policy',  [PublicController::class, 'privacy'])->name('legal.privacy');
Route::get('/legal/terms',           [PublicController::class, 'terms'])->name('legal.terms');
Route::get('/legal/cookie-policy',   [PublicController::class, 'cookies'])->name('legal.cookies');
