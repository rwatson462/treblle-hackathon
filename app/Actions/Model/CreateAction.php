<?php

namespace App\Actions\Model;

use App\Exceptions\DuplicateModelException;
use App\Models\HeadlessModel;
use App\Models\User;
use PDOException;

final readonly class CreateAction
{
    /**
     * @param array<string,string> $modelData
     * @return string
     */
    public function execute(array $modelData, User $authUser): string
    {
        try {
            return HeadlessModel::create([
                ...$modelData,
                'user_id' => $authUser->id,
            ])->id;
        } catch (PDOException $t) {
            throw new DuplicateModelException($t->getMessage());
        }
    }
}
