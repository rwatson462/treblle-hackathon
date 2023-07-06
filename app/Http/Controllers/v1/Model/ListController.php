<?php

namespace App\Http\Controllers\v1\Model;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Model\HeadlessModelResource;
use App\Http\Responses\AppResponse;
use App\Models\HeadlessModel;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __invoke(Request $request)
    {
        return new AppResponse([
            'models' => HeadlessModelResource::collection(HeadlessModel::all()),
        ]);
    }
}
