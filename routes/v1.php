<?php

/**
 * Routes for VERSION 1 of this API
 */

use App\Http\Controllers\v1\Auth\LoginController;
use App\Http\Controllers\v1\Auth\LogoutController;
use App\Http\Controllers\v1\Auth\ProfileController;
use App\Http\Controllers\v1\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', RegisterController::class)->name('auth.register');
    Route::post('/login', LoginController::class)->name('auth.login');
});

Route::middleware(['auth:sanctum', \Treblle\Middlewares\TreblleMiddleware::class])->group(function() {
    Route::prefix('/auth')->group(function() {
        Route::post('/logout', LogoutController::class)->name('auth.logout');
        Route::get('/me', ProfileController::class)->name('auth.profile');
    });

    Route::prefix('/model')->as('model.')->group(function() {
        Route::post('/', App\Http\Controllers\v1\Model\CreateController::class)->name('create');
        Route::delete('/{uuid}', App\Http\Controllers\v1\Model\DeleteController::class)->name('delete');
        Route::get('/', App\Http\Controllers\v1\Model\ListController::class)->name('list');

        Route::prefix('/{uuid}')->as('instance.')->group(function() {
            Route::get('/', \App\Http\Controllers\v1\Instance\ListController::class)->name('list');
            Route::post('/', \App\Http\Controllers\v1\Instance\CreateController::class)->name('create');

            Route::prefix('{instance_uuid}')->group(function () {
                Route::get('/', \App\Http\Controllers\v1\Instance\GetController::class)->name('get');
                Route::delete('/', \App\Http\Controllers\v1\Instance\DeleteController::class)->name('delete');
            });
        });

    });
});
