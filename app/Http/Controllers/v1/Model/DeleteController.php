<?php

namespace App\Http\Controllers\v1\Model;

use App\Actions\Model\DeleteAction;
use App\Http\Responses\AppResponse;
use App\Http\Responses\Model\DeletedResponse;

class DeleteController
{
    public function __invoke(string $uuid, DeleteAction $deleteAction): AppResponse
    {
        $deleteAction->execute($uuid);

        return DeletedResponse::make();
    }
}
