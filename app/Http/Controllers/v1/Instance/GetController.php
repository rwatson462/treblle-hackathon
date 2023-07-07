<?php

namespace App\Http\Controllers\v1\Instance;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Model\HeadlessModelInstanceResource;
use App\Http\Resources\v1\Model\HeadlessModelResource;
use App\Http\Responses\AppResponse;
use App\Repositories\HeadlessInstanceRepository;


final class GetController extends Controller
{
    public function __invoke(string $uuid, string $instance_uuid, HeadlessInstanceRepository $repository)
    {
        $instance = $repository->findById($instance_uuid);

        return new AppResponse([
            'instance' => new HeadlessModelInstanceResource($instance),
            'model' => new HeadlessModelResource($instance->model),
        ]);
    }
}
