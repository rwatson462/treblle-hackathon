<?php

namespace App\Actions\Auth;

use App\Exceptions\DuplicateModelException;
use App\Models\User;

final readonly class RegisterAction
{
    public function execute(array $userData): string
    {
        try {
            return User::create($userData)->id;
        } catch (\PDOException $e) {
            // Todo: double check that a duplicate entry is the actual error
            throw new DuplicateModelException($e->getMessage());
        }
    }
}
