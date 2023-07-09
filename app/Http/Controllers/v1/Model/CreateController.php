<?php

namespace App\Http\Controllers\v1\Model;

use App\Actions\Model\CreateAction;
use App\DataTransferObjects\Requests\Model\CreateRequestDto;
use App\Exceptions\DuplicateModelException;
use App\Http\Requests\v1\Model\CreateRequest;
use App\Http\Responses\AppResponse;
use App\Http\Responses\Model\CreatedResponse;
use App\Http\Responses\UnprocessableEntityResponse;

final class CreateController
{
    public function __invoke(CreateRequestDto $data, CreateAction $createAction): AppResponse
    {
        try {

            return CreatedResponse::make(
                $createAction->execute($data, authUser())
            );

        } catch (DuplicateModelException) {

            return UnprocessableEntityResponse::make('cannot create duplicate model');

        }
    }
}
