<?php

namespace App\Http\Controllers\Model;

use App\Http\Controllers\Controller;
use App\Http\Requests\Model\CreateRequest;
use App\Http\Responses\AppResponse;
use App\Models\HeadlessModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {
        $model = HeadlessModel::create([
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);

        return new AppResponse([
            'message' => 'created',
            'model_id' => $model->id,
        ], Response::HTTP_CREATED);
    }
}
