<?php

namespace App\Http\Controllers\v1\Model;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Model\DeleteRequest;
use App\Http\Responses\AppResponse;
use App\Models\HeadlessModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{
    public function __invoke(DeleteRequest $request)
    {
        // To get here, we have already authenticated the user and validated that the model_id exists in the database
        HeadlessModel::where('id', $request->validated()['model_id'])->delete();

        return new AppResponse([
            'message' => 'deleted',
        ], Response::HTTP_OK);
    }
}
