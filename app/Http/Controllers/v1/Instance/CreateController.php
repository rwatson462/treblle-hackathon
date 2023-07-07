<?php

namespace App\Http\Controllers\v1\Instance;

use App\Actions\Instance\CreateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Instance\CreateRequest;
use App\Http\Responses\AppResponse;
use Symfony\Component\HttpFoundation\Response;

final class CreateController extends Controller
{
    public function __invoke(CreateRequest $request, string $uuid, CreateAction $createAction)
    {
        return new AppResponse([
            'message' => 'created',
            'instance_id' => $createAction->execute($uuid, $request->validated()),
        ], Response::HTTP_CREATED);
    }
}
