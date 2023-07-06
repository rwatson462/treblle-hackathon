<?php

namespace App\Http\Controllers\v1\Auth;

use App\Actions\Auth\RegisterAction;
use App\Exceptions\DuplicateModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\RegisterRequest;
use App\Http\Responses\AppResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, RegisterAction $registerUserAction): AppResponse
    {
        try {

            return new AppResponse([
                'message' => 'success',
                'user_id' => $registerUserAction->execute($request->validated()),
            ], Response::HTTP_CREATED);

        } catch (DuplicateModelException) {

            return new AppResponse([
                'message' => 'error registering user',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

        }
    }
}
