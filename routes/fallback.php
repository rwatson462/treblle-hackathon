<?php

use App\Http\Responses\AppResponse;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::fallback(function() {
    return new AppResponse([
        'message' => 'not found',
    ], Response::HTTP_NOT_FOUND);
});
