<?php

/**
 * Routes for VERSION 1 of this API
 */

use App\Http\Controllers\v1\Auth\LoginController;
use App\Http\Controllers\v1\Auth\LogoutController;
use App\Http\Controllers\v1\Auth\ProfileController;
use App\Http\Controllers\v1\Auth\RegisterController;
use App\Http\Controllers\v1\Model\CreateController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', RegisterController::class)->name('auth.register');
    Route::post('/login', LoginController::class)->name('auth.login');
});

Route::middleware(['auth:sanctum', 'treblle'])->group(function() {
    Route::prefix('/auth')->group(function() {
        Route::post('/logout', LogoutController::class)->name('auth.logout');
        Route::get('/me', ProfileController::class)->name('auth.profile');
    });

    Route::prefix('/model')->as('model.')->group(function() {
        Route::post('/create', CreateController::class)->name('create');
    });
});
