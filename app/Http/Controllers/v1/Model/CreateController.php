<?php

namespace App\Http\Controllers\v1\Model;

use App\Actions\Model\CreateAction;
use App\Exceptions\DuplicateModelException;
use App\Http\Requests\v1\Model\CreateRequest;
use App\Http\Responses\AppResponse;
use App\Http\Responses\Model\CreatedResponse;
use App\Http\Responses\UnprocessableEntityResponse;

final class CreateController
{
    public function __invoke(CreateRequest $request, CreateAction $createAction): AppResponse
    {
        try {

            /** @var array<string,string> $data */
            $data = $request->validated();

            return CreatedResponse::make(
                $createAction->execute($data)
            );

        } catch (DuplicateModelException) {

            return UnprocessableEntityResponse::make('cannot create duplicate model');

        }
    }
}
