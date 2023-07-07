<?php

namespace App\Http\Responses\Auth;

use App\Http\Responses\AppResponse;

class RegisteredResponse extends AppResponse
{
    public static function make(string $userId): AppResponse
    {
        return new AppResponse([
            'message' => 'success',
            'user_id' => $userId,
        ], self::HTTP_CREATED);
    }
}
