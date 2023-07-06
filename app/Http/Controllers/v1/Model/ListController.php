<?php

namespace App\Http\Controllers\v1\Model;

use App\Http\Responses\AppResponse;
use App\Http\Responses\Model\ListResponse;
use App\Repositories\HeadlessModelRepository;

class ListController
{
    public function __invoke(HeadlessModelRepository $repository): AppResponse
    {
        return ListResponse::make($repository->getAll());
    }
}
