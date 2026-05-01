<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Settings\OrgSettingsController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\SiteController;
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

        // Media
        Route::get('/media',                    [MediaController::class, 'index'])->name('media.index');
        Route::post('/media',                   [MediaController::class, 'store'])->name('media.store');
        Route::patch('/media/{media}',          [MediaController::class, 'update'])->name('media.update');
        Route::delete('/media/{media}',         [MediaController::class, 'destroy'])->name('media.destroy');

        // Pages
        Route::get('/pages',                    [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/create',             [PageController::class, 'create'])->name('pages.create');
        Route::post('/pages',                   [PageController::class, 'store'])->name('pages.store');
        Route::get('/pages/{page}/edit',        [PageController::class, 'edit'])->name('pages.edit');
        Route::get('/pages/{page}/preview',     [PageController::class, 'preview'])->name('pages.preview');
        Route::put('/pages/{page}',             [PageController::class, 'update'])->name('pages.update');
        Route::patch('/pages/{page}/publish',   [PageController::class, 'publish'])->name('pages.publish');
        Route::patch('/pages/{page}/unpublish', [PageController::class, 'unpublish'])->name('pages.unpublish');
        Route::delete('/pages/{page}',          [PageController::class, 'destroy'])->name('pages.destroy');

        // Sections (AJAX)
        Route::post('/pages/{page}/sections',            [SectionController::class, 'store'])->name('sections.store');
        Route::patch('/sections/{section}',              [SectionController::class, 'update'])->name('sections.update');
        Route::delete('/sections/{section}',             [SectionController::class, 'destroy'])->name('sections.destroy');
        Route::post('/pages/{page}/sections/reorder',    [SectionController::class, 'reorder'])->name('sections.reorder');

        // Donations
        Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');

        // Forms
        Route::get('/forms', [FormController::class, 'index'])->name('forms.index');

        // Events
        Route::get('/events',                                        [EventController::class, 'index'])->name('events.index');
        Route::get('/events/create',                                 [EventController::class, 'create'])->name('events.create');
        Route::post('/events',                                       [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit',                           [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}',                                [EventController::class, 'update'])->name('events.update');
        Route::patch('/events/{event}/publish',                      [EventController::class, 'publish'])->name('events.publish');
        Route::patch('/events/{event}/unpublish',                    [EventController::class, 'unpublish'])->name('events.unpublish');
        Route::delete('/events/{event}',                             [EventController::class, 'destroy'])->name('events.destroy');
        Route::get('/events/{event}/registrations',                  [EventController::class, 'registrations'])->name('events.registrations');
        Route::patch('/events/{event}/registrations/{registration}', [EventController::class, 'updateRegistration'])->name('events.registrations.update');
        Route::get('/events/{event}/registrations/export',           [EventController::class, 'exportRegistrations'])->name('events.registrations.export');
    });
});

// --- Platform admin ---
Route::middleware(['auth', 'platform.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                           [AdminController::class, 'index'])->name('index');
    Route::patch('/{org}/approve',            [AdminController::class, 'approve'])->name('approve');
    Route::patch('/{org}/reject',             [AdminController::class, 'reject'])->name('reject');
    Route::patch('/{org}/suspend',            [AdminController::class, 'suspend'])->name('suspend');
    Route::patch('/{org}/reinstate',          [AdminController::class, 'reinstate'])->name('reinstate');
});

// --- Charity public site (test server path-based access) ---
Route::get('/sites/{orgSlug}',                              [SiteController::class, 'home'])->name('site.home');
Route::get('/sites/{orgSlug}/events/{eventSlug}',           [PublicEventController::class, 'show'])->name('site.event');
Route::post('/sites/{orgSlug}/events/{eventSlug}/register', [PublicEventController::class, 'register'])->name('site.event.register');
Route::get('/sites/{orgSlug}/{pageSlug}',                   [SiteController::class, 'page'])->name('site.page');

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
