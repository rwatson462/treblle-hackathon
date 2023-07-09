<?php

namespace App\Http\Responses\Instance;

use App\Http\Resources\v1\Model\HeadlessModelInstanceResource;
use App\Http\Responses\AppResponse;
use App\Models\HeadlessModelInstance;
use Illuminate\Support\Collection;

class ListResponse
{
    /**
     * @param Collection<int, HeadlessModelInstance> $instances
     * @return AppResponse
     */
    public static function make(Collection $instances): AppResponse
    {
        return new AppResponse([
            'models' => HeadlessModelInstanceResource::collection($instances),
        ]);
    }
}
