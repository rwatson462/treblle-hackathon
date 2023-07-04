<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Responses\AppResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): AppResponse
    {
        if (! Auth::attempt($request->validated())) {
            return new AppResponse([
                'message' => 'invalid email/password combination',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $expiry = now()->addHours(1);
        $token = request()->user()->createToken(
            name: 'authentication',
            expiresAt: $expiry,
        );

        return new AppResponse([
            'message' => 'success',
            'token' => $token->plainTextToken,
            'expires' => $expiry,
        ]);
    }
}
