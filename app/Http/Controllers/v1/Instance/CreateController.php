<?php

namespace App\Http\Controllers\v1\Instance;

use App\Actions\Instance\CreateAction;
use App\Http\Requests\v1\Instance\CreateRequest;
use App\Http\Responses\AppResponse;
use App\Http\Responses\Instance\CreatedResponse;

final class CreateController
{
    public function __invoke(CreateRequest $request, string $uuid, CreateAction $createAction): AppResponse
    {
        return CreatedResponse::make(
            $createAction->execute($uuid, $request->validated())
        );
    }
}
