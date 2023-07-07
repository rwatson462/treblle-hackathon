<?php

namespace App\Repositories;

use App\Exceptions\DuplicateModelException;
use App\Models\User;

class UserRepository
{
    public function create(array $userData): User
    {
        try {

            return User::create($userData);

        } catch (\PDOException $e) {

            // TODO: perhaps catch more SQL errors here
            if (str_starts_with($e->getMessage(), 'SQLSTATE[23000]')) {
                throw new DuplicateModelException($e->getMessage());
            }
            throw $e;

        }
    }
}
