<?php

namespace App\Http\Controllers\v1\Instance;

use App\Http\Responses\AppResponse;
use App\Http\Responses\Instance\ListResponse;
use App\Repositories\HeadlessModelRepository;

final class ListController
{
    public function __invoke(string $uuid, HeadlessModelRepository $repository): AppResponse
    {
        $model = $repository->findById($uuid)->load('instances');

        return ListResponse::make($model->instances);
    }
}
