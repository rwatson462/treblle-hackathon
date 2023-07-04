<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Auth\UserResource;
use App\Http\Responses\AppResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __invoke(): AppResponse
    {
        return new AppResponse(new UserResource(auth()->user()));
    }
}
