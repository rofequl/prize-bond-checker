<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'home'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/result-verify', [AuthController::class, 'resultVerify'])->name('dashboard.result-verify');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.attempt');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/series', [AdminAuthController::class, 'series'])->name('admin.series');
        Route::post('/series', [AdminAuthController::class, 'storeSeries'])->name('admin.series.store');
        Route::patch('/series/{series}/toggle', [AdminAuthController::class, 'toggleSeries'])->name('admin.series.toggle');
        Route::get('/users', [AdminAuthController::class, 'users'])->name('admin.users');
        Route::get('/results', [AdminAuthController::class, 'results'])->name('admin.results');
        Route::post('/results', [AdminAuthController::class, 'storeResult'])->name('admin.results.store');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});
