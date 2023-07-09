<?php

namespace App\Http\Controllers\v1\Auth;

use App\Events\v1\Auth\UserLoggedOut;
use App\Http\Responses\AppResponse;

use function authUser;

class LogoutController
{
    public function __invoke(): AppResponse
    {
        // Todo: only invalidate the token currently being used (i.e. that which was passed in via Bearer Auth)
        authUser()->tokens()->delete();

        event(new UserLoggedOut(authUser()));

        return new AppResponse([
            'message' => 'logged out',
        ]);
    }
}
