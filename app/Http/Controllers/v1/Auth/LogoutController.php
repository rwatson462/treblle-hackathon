<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Responses\AppResponse;

class LogoutController
{
    public function __invoke(): AppResponse
    {
        // Todo: only invalidate the token currently being used (i.e. that which was passed in via Bearer Auth)
        auth()->user()->tokens()->where('expires_at', '>', now())->delete();

        return new AppResponse([
            'message' => 'logged out',
        ]);
    }
}
