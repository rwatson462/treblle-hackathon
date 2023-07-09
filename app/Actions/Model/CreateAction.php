<?php

namespace App\Actions\Model;

use App\Exceptions\DuplicateModelException;
use App\Models\HeadlessModel;
use PDOException;

final readonly class CreateAction
{
    /**
     * @param array<string,string> $modelData
     * @return string
     */
    public function execute(array $modelData): string
    {
        try {
            assert(auth()->user() !== null);

            return HeadlessModel::create([
                ...$modelData,
                'user_id' => auth()->user()->id,
            ])->id;
        } catch (PDOException $t) {
            throw new DuplicateModelException($t->getMessage());
        }
    }
}
