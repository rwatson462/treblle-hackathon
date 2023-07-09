<?php

namespace App\Actions\Auth;

use App\DataTransferObjects\Requests\Auth\RegisterRequestDto;
use App\Events\v1\Auth\UserRegistered;
use App\Repositories\UserRepository;

final readonly class RegisterAction
{
    public function __construct(
        private UserRepository $repository,
    ) { }

    public function execute(RegisterRequestDto $userData): string
    {
        $user = $this->repository->create($userData->toArray());

        event(new UserRegistered($user));

        return $user->id;
    }
}
