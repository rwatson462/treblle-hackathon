<?php

namespace App\Http\Responses\Instance;

use App\Http\Responses\AppResponse;

class CreatedResponse extends AppResponse
{
    public static function make(string $instanceId): AppResponse
    {
        return new AppResponse(
            data: [
                'message' => 'created',
                'instance_id' => $instanceId,
            ],
            status: self::HTTP_CREATED
        );
    }
}
