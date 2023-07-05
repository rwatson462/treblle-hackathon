<?php

namespace App\Http\Controllers\v1\Model;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Model\CreateRequest;
use App\Http\Responses\AppResponse;
use App\Models\HeadlessModel;
use PDOException;
use Symfony\Component\HttpFoundation\Response;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {
        try {
            $model = HeadlessModel::create([
                ...$request->validated(),
                'user_id' => auth()->user()->id,
            ]);
        } catch (PDOException) {
            /**
             * The beauty of this code is that it's vague for the user,
             * yet Treblle records the exception message!
             */
            return new AppResponse([
                'message' => 'cannot create duplicate model',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new AppResponse([
            'message' => 'created',
            'model_id' => $model->id,
        ], Response::HTTP_CREATED);
    }
}
