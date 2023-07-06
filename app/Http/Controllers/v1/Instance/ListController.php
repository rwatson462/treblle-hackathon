<?php

namespace App\Http\Controllers\v1\Instance;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Model\HeadlessModelInstanceResource;
use App\Http\Responses\AppResponse;
use App\Models\HeadlessModel;
use App\Models\HeadlessModelInstance;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __invoke(string $uuid)
    {
        // Todo: (out of scope for this exercise) - implement a Repository to fetch the model instance

        $model = HeadlessModel::findOrFail($uuid);

        return new AppResponse([
            'models' => HeadlessModelInstanceResource::collection($model->instances),
        ]);
    }
}
