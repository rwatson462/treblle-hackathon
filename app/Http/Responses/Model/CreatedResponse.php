<?php

namespace App\Http\Responses\Model;

use App\Http\Responses\AppResponse;

class CreatedResponse extends \App\Http\Responses\AppResponse
{
    public static function make(string $id): AppResponse
    {
        return new AppResponse([
            'message' => 'created',
            'model_id' => $id,
        ], static::HTTP_CREATED);
    }
}
