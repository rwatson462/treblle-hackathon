<?php

namespace App\Http\Responses\Instance;

use App\Http\Responses\AppResponse;
use Symfony\Component\HttpFoundation\Response;

class CreatedResponse
{
    public static function make(string $instanceId): AppResponse
    {
        return new AppResponse(
            data: [
                'message' => 'created',
                'instance_id' => $instanceId,
            ],
            status: Response::HTTP_CREATED
        );
    }
}
