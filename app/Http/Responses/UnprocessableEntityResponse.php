<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;

class UnprocessableEntityResponse
{
    public static function make(string $message): AppResponse
    {
        return new AppResponse([
            'message' => $message,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
