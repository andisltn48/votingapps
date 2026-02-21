<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Middleware\EnsureIsAdmin;

// Public Routes
Route::get('/', [ParticipantController::class, 'create'])->name('participant.create');
Route::post('/daftar', [ParticipantController::class, 'store'])->name('participant.store');
Route::get('/sukses', [ParticipantController::class, 'success'])->name('participant.success');

// Admin Auth Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware([EnsureIsAdmin::class])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/pendaftar/export', [AdminDashboardController::class, 'export'])->name('admin.pendaftar.export');
        Route::delete('/pendaftar/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.pendaftar.destroy');

        Route::get('/voting', [\App\Http\Controllers\Admin\VoteController::class, 'index'])->name('admin.voting');
    });
});
