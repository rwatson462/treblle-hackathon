<?php

namespace App\Http\Controllers\v1\Instance;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Instance\CreateRequest;
use App\Http\Responses\AppResponse;
use App\Models\HeadlessModelInstance;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request, string $uuid)
    {
        $instance = HeadlessModelInstance::create([
            'model_id' => $uuid,
            'attributes' => $request->validated(),
        ]);

        return new AppResponse([
            'message' => 'created',
            'instance_id' => $instance->id,
        ], Response::HTTP_CREATED);
    }
}
