<?php

namespace App\Actions\Auth;

use App\Events\v1\Auth\UserRegistered;
use App\Repositories\UserRepository;

final readonly class RegisterAction
{
    public function __construct(
        private UserRepository $repository,
    ) { }

    /**
     * @param array<string,string> $userData
     * @return string
     */
    public function execute(array $userData): string
    {
        $user = $this->repository->create($userData);

        event(new UserRegistered($user));

        return $user->id;
    }
}
