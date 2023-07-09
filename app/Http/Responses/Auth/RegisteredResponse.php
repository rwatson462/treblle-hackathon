<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\AppResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisteredResponse
{
    public static function make(string $userId): AppResponse
    {
        return new AppResponse([
            'message' => 'success',
            'user_id' => $userId,
        ], Response::HTTP_CREATED);
    }
}
