<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasienDashboardController;
use App\Http\Controllers\BloodPressureController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [CustomAuthController::class, 'showLoginForm'])->name('login');
Route::get('/auth/google', [CustomAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [CustomAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');

// Profile Setup Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/setup', [ProfileController::class, 'showSetup'])->name('profile.setup');
    Route::post('/profile/setup', [ProfileController::class, 'storeSetup'])->name('profile.setup.store');
    
    // Pasien Dashboard Routes
    Route::middleware(['role:pasien'])->group(function () {
        Route::get('/pasien/dashboard', [PasienDashboardController::class, 'index'])->name('pasien.dashboard');
        
        // Blood Pressure CRUD Routes
        Route::get('/pasien/blood-pressure/create', [BloodPressureController::class, 'create'])->name('pasien.blood-pressure.create');
        Route::post('/pasien/blood-pressure', [BloodPressureController::class, 'store'])->name('pasien.blood-pressure.store');
        Route::get('/pasien/blood-pressure/{id}/edit', [BloodPressureController::class, 'edit'])->name('pasien.blood-pressure.edit');
        Route::put('/pasien/blood-pressure/{id}', [BloodPressureController::class, 'update'])->name('pasien.blood-pressure.update');
        Route::delete('/pasien/blood-pressure/{id}', [BloodPressureController::class, 'destroy'])->name('pasien.blood-pressure.destroy');
    });
});