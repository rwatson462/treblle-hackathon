<?php

namespace App\Http\Controllers\v1\Instance;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Model\HeadlessModelInstanceResource;
use App\Http\Resources\v1\Model\HeadlessModelResource;
use App\Http\Responses\AppResponse;
use App\Models\HeadlessModel;
use App\Models\HeadlessModelInstance;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function __invoke(string $uuid, string $instance_uuid)
    {
        /** @var HeadlessModel $model */
        $model = HeadlessModel::findOrFail($uuid);

        /** @var ?HeadlessModelInstance $instance */
        $instance = $model->instances()->firstWhere('id', $instance_uuid);

        if (! $instance) {
            throw new ModelNotFoundException();
        }

        return new AppResponse([
            'instance' => new HeadlessModelInstanceResource($instance),
            'model' => new HeadlessModelResource($model),
        ]);
    }
}
