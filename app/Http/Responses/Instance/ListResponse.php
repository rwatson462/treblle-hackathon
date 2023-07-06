<?php

namespace App\Http\Responses\Instance;

use App\Http\Resources\v1\Model\HeadlessModelInstanceResource;
use App\Http\Responses\AppResponse;
use App\Models\HeadlessModel;
use Illuminate\Support\Collection;

class ListResponse extends AppResponse
{
    public static function make(Collection $instances): AppResponse
    {
        return new AppResponse([
            'models' => HeadlessModelInstanceResource::collection($instances),
        ]);
    }
}
