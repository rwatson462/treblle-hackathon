<?php

namespace App\Http\Responses\Instance;

use App\Http\Responses\AppResponse;

class DeletedResponse
{
    public static function make(): AppResponse
    {
        return new AppResponse([
            'message' => 'deleted',
        ]);
    }
}
