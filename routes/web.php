<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'home'])->name('home');
Route::get('/results', [AuthController::class, 'publicResults'])->name('results.public');
Route::get('/help', [AuthController::class, 'help'])->name('help');
Route::get('/sitemap.xml', [AuthController::class, 'sitemap'])->name('sitemap');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:8,1')
        ->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('throttle:5,10')
        ->name('register.store');

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
        ->middleware('throttle:5,10')
        ->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->middleware('throttle:5,10')
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [AuthController::class, 'showVerifyNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard/result-verify', [AuthController::class, 'resultVerify'])->name('dashboard.result-verify');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('admin.login.attempt');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/series', [AdminAuthController::class, 'series'])->name('admin.series');
        Route::post('/series', [AdminAuthController::class, 'storeSeries'])->name('admin.series.store');
        Route::patch('/series/{series}/toggle', [AdminAuthController::class, 'toggleSeries'])->name('admin.series.toggle');
        Route::get('/users', [AdminAuthController::class, 'users'])->name('admin.users');
        Route::get('/results', [AdminAuthController::class, 'results'])->name('admin.results');
        Route::post('/results', [AdminAuthController::class, 'storeResult'])->name('admin.results.store');
        Route::get('/results/{draw}/edit', [AdminAuthController::class, 'editResult'])->name('admin.results.edit');
        Route::put('/results/{draw}', [AdminAuthController::class, 'updateResult'])->name('admin.results.update');
        Route::delete('/results/{draw}', [AdminAuthController::class, 'destroyResult'])->name('admin.results.destroy');
        Route::get('/smtp', [AdminAuthController::class, 'smtp'])->name('admin.smtp');
        Route::post('/smtp', [AdminAuthController::class, 'updateSmtp'])->name('admin.smtp.update');
        Route::post('/smtp/test', [AdminAuthController::class, 'sendSmtpTest'])->name('admin.smtp.test');
        Route::get('/system', [AdminAuthController::class, 'system'])->name('admin.system');
        Route::post('/system/storage-link', [AdminAuthController::class, 'runStorageLink'])->name('admin.system.storage-link');
        Route::post('/system/clear-cache', [AdminAuthController::class, 'runClearCache'])->name('admin.system.clear-cache');
        Route::post('/system/migrate', [AdminAuthController::class, 'runMigrate'])->name('admin.system.migrate');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});
