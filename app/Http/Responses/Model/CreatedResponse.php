<?php

namespace App\Http\Responses\Model;

use App\Http\Responses\AppResponse;
use Symfony\Component\HttpFoundation\Response;

class CreatedResponse
{
    public static function make(string $id): AppResponse
    {
        return new AppResponse([
            'message' => 'created',
            'model_id' => $id,
        ], Response::HTTP_CREATED);
    }
}
