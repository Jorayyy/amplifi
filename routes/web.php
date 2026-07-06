<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 1. Routes for ALL logged-in employees (including Admins)
Route::middleware(['auth', 'verified'])->group(function () {
    // Make sure these two lines are exactly here!
    Route::get('/dashboard', [TrackingController::class, 'index'])->name('dashboard');
    Route::post('/generate-link/{content}', [TrackingController::class, 'generateLink'])->name('generate.link');
});

// 2. Routes ONLY for logged-in Admins
Route::middleware(['auth', 'verified', \App\Http\Middleware\EnsureUserIsAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{content}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{content}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{content}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

// Public URL format that tracks client redirects
Route::get('/share/{code}', [TrackingController::class, 'trackClick'])->name('track.click');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
