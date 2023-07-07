<?php

namespace App\Http\Responses\Instance;

use App\Http\Resources\v1\Model\HeadlessModelInstanceResource;
use App\Http\Resources\v1\Model\HeadlessModelResource;
use App\Http\Responses\AppResponse;
use App\Models\HeadlessModelInstance;

class GetResponse extends AppResponse
{
    public static function make(HeadlessModelInstance $instance): AppResponse
    {
        return new AppResponse([
            'instance' => new HeadlessModelInstanceResource($instance),
            'model' => new HeadlessModelResource($instance->model),
        ]);
    }
}
