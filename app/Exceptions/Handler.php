<?php

namespace App\Exceptions;

use App\Http\Responses\AppResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        /**
         * Convert errors that Laravel throws for accessing a GET route with POST
         * into 404's which are more appropriate
         */
        $this->renderable(function (MethodNotAllowedHttpException $e) {
            return new AppResponse([
                'message' => 'not found',
            ], Response::HTTP_NOT_FOUND);
        });

        /**
         * Catch any other exception and return a more friendly and vague 500 response
         */
        $this->reportable(function (Throwable $e) {
            return new AppResponse([
                'message' => 'internal server error',
            ], 500);
        });
    }
}
