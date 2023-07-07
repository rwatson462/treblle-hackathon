<?php

namespace App\Http\Controllers\v1\Model;

use App\Actions\Model\DeleteAction;
use App\Http\Controllers\Controller;
use App\Http\Responses\AppResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{
    public function __invoke(string $uuid, DeleteAction $deleteAction)
    {
        $deleteAction->execute($uuid);

        return new AppResponse([
            'message' => 'deleted',
        ], Response::HTTP_OK);
    }
}
