<?php

namespace App\Http\Controllers\v1\Auth;

use App\Actions\Auth\RegisterAction;
use App\DataTransferObjects\Requests\Auth\RegisterRequestDto;
use App\Exceptions\DuplicateModelException;
use App\Http\Responses\AppResponse;
use App\Http\Responses\Auth\RegisteredResponse;
use App\Http\Responses\UnprocessableEntityResponse;

class RegisterController
{
    public function __invoke(RegisterRequestDto $data, RegisterAction $registerUserAction): AppResponse
    {
        try {

            $userId = $registerUserAction->execute($data);

            return RegisteredResponse::make($userId);

        } catch (DuplicateModelException) {

            return UnprocessableEntityResponse::make('error registering user');

        }
    }
}
