<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\AppResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
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
