<?php

namespace App\Http\Controllers\v1\Model;

use App\Actions\Model\CreateAction;
use App\Exceptions\DuplicateModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Model\CreateRequest;
use App\Http\Responses\AppResponse;
use Symfony\Component\HttpFoundation\Response;

final class CreateController extends Controller
{
    public function __invoke(CreateRequest $request, CreateAction $createAction)
    {
        try {

            return new AppResponse([
                'message' => 'created',
                'model_id' => $createAction->execute($request->validated()),
            ], Response::HTTP_CREATED);

        } catch (DuplicateModelException) {

            /**
             * The beauty of this code is that it's vague for the user,
             * yet Treblle records the exception message!
             */
            return new AppResponse([
                'message' => 'cannot create duplicate model',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

        }
    }
}
