<?php

namespace App\Http\Responses\Model;

use App\Http\Resources\v1\Model\HeadlessModelResource;
use App\Http\Responses\AppResponse;
use Illuminate\Support\Collection;

class ListResponse extends AppResponse
{
    public static function make(Collection $models): AppResponse
    {
        return new AppResponse([
            'models' => HeadlessModelResource::collection($models),
        ]);
    }
}
