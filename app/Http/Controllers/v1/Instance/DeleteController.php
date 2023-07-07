<?php

namespace App\Http\Controllers\v1\Instance;

use App\Http\Controllers\Controller;
use App\Http\Responses\Instance\DeletedResponse;
use App\Repositories\HeadlessInstanceRepository;

class DeleteController extends Controller
{
    public function __invoke(HeadlessInstanceRepository $repository, string $uuid, string $instance_uuid)
    {
        $repository->delete($instance_uuid);

        return DeletedResponse::make();
    }
}
