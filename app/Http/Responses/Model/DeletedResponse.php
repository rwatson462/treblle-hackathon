<?php

namespace App\Http\Responses\Model;

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
