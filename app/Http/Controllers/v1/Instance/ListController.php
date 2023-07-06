<?php

namespace App\Http\Controllers\v1\Instance;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Model\HeadlessModelInstanceResource;
use App\Http\Responses\AppResponse;
use App\Models\HeadlessModel;
use App\Models\HeadlessModelInstance;
use App\Repositories\HeadlessModelRepository;
use Illuminate\Http\Request;

final class ListController extends Controller
{
    public function __invoke(string $uuid, HeadlessModelRepository $repository)
    {
        $model = $repository->findById($uuid);

        return new AppResponse([
            'models' => HeadlessModelInstanceResource::collection($model->instances),
        ]);
    }
}
