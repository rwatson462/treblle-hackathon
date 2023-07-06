<?php

namespace app\Http\Responses\Model;

use App\Http\Responses\AppResponse;

class DeletedResponse extends AppResponse
{
    public static function make(): AppResponse
    {
        return new AppResponse(
            data: [
                'message' => 'deleted',
            ],
            status: self::HTTP_OK
        );
    }
}
