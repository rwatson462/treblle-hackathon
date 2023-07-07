<?php

namespace App\Actions\Model;

use App\Exceptions\DuplicateModelException;
use App\Models\HeadlessModel;

final readonly class CreateAction
{
    public function execute(array $modelData): string
    {
        try {
            return HeadlessModel::create([
                ...$modelData,
                'user_id' => auth()->user()->id,
            ])->id;
        } catch (\PDOException $t) {
            throw new DuplicateModelException($t->getMessage());
        }
    }
}
