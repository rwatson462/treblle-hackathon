<?php

namespace App\Http\Controllers\v1\Instance;

use App\Http\Responses\AppResponse;
use App\Http\Responses\Instance\GetResponse;
use App\Repositories\HeadlessInstanceRepository;

final class GetController
{
    public function __invoke(string $uuid, string $instance_uuid, HeadlessInstanceRepository $repository): AppResponse
    {
        $instance = $repository->findById($instance_uuid);

        return GetResponse::make($instance);
    }
}
