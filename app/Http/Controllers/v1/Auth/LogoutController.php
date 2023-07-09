<?php

namespace App\Http\Controllers\v1\Auth;

use App\Events\v1\Auth\UserLoggedOut;
use App\Http\Responses\AppResponse;

class LogoutController
{
    public function __invoke(): AppResponse
    {
        assert(auth()->user() !== null);

        // Todo: only invalidate the token currently being used (i.e. that which was passed in via Bearer Auth)
        auth()->user()->tokens()->delete();

        event(new UserLoggedOut(auth()->user()));

        return new AppResponse([
            'message' => 'logged out',
        ]);
    }
}
