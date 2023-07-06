<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Responses\AppResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{
    public function __invoke(LoginRequest $request): AppResponse
    {
        if (! Auth::attempt($request->validated())) {
            return new AppResponse([
                'message' => 'invalid email/password combination',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $expiry = now()->addMinutes(config('auth.token_timeout'));

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
