<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->as('v1.')->group(base_path('routes/v1.php'));

Route::prefix('/')->group(base_path('routes/fallback.php'));
