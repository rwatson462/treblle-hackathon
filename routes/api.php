<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', \App\Http\Controllers\Auth\RegisterController::class)
        ->name('auth.register');
});
