<?php

namespace App\Actions\Auth;

use App\Events\v1\Auth\UserRegistered;
use App\Exceptions\DuplicateModelException;
use App\Models\User;

final readonly class RegisterAction
{
    public function execute(array $userData): string
    {
        try {
            $user = User::create($userData);

            event(new UserRegistered($user));

            return $user->id;
        } catch (\PDOException $e) {
            // Todo: double check that a duplicate entry is the actual error
            throw new DuplicateModelException($e->getMessage());
        }
    }
}
