<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Resources\v1\Auth\UserResource;
use App\Http\Responses\AppResponse;

use function authUser;

class ProfileController
{
    public function __invoke(): AppResponse
    {
        return new AppResponse(new UserResource(authUser()));
    }
}
