<?php

namespace App\Http\Controllers\v1\Auth;

use App\Actions\Auth\RegisterAction;
use App\Events\v1\Auth\UserRegistered;
use App\Exceptions\DuplicateModelException;
use App\Http\Requests\v1\Auth\RegisterRequest;
use App\Http\Responses\AppResponse;
use App\Http\Responses\Auth\RegisteredResponse;
use App\Http\Responses\UnprocessableEntityResponse;

class RegisterController
{
    public function __invoke(RegisterRequest $request, RegisterAction $registerUserAction): AppResponse
    {
        try {

            $userId = $registerUserAction->execute($request->validated());

            return RegisteredResponse::make($userId);

        } catch (DuplicateModelException) {

            return UnprocessableEntityResponse::make('error registering user');

        }
    }
}
