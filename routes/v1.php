<?php

/**
 * Routes for VERSION 1 of this API
 */

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', \app\Http\Controllers\v1\Auth\RegisterController::class)
        ->name('auth.register');
});
