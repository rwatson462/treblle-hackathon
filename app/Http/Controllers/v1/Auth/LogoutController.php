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
        auth()->user()->tokens()->delete();

        return new AppResponse([
            'message' => 'logged out',
        ]);
    }
}
