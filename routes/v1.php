<?php

/**
 * Routes for VERSION 1 of this API
 */

use App\Http\Controllers\v1\Auth\LoginController;
use App\Http\Controllers\v1\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', RegisterController::class)
        ->name('auth.register');
    Route::post('/login', LoginController::class)
        ->name('auth.login');
});
