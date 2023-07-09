<?php

namespace App\Actions\Model;

use App\DataTransferObjects\Requests\Model\CreateRequestDto;
use App\Exceptions\DuplicateModelException;
use App\Models\HeadlessModel;
use App\Models\User;
use PDOException;

final readonly class CreateAction
{
    public function execute(CreateRequestDto $modelData, User $authUser): string
    {
        try {
            return HeadlessModel::create([
                ...$modelData->toArray(),
                'user_id' => $authUser->id,
            ])->id;
        } catch (PDOException $t) {
            throw new DuplicateModelException($t->getMessage());
        }
    }
}
