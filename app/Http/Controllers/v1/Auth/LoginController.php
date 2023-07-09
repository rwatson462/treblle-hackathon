<?php

namespace App\Http\Controllers\v1\Auth;

use App\Events\v1\Auth\UserLoggedIn;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Responses\AppResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{
    public function __invoke(LoginRequest $request): AppResponse
    {
        /** @var array<string,string> $credentials */
        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            return new AppResponse([
                'message' => 'invalid email/password combination',
            ], Response::HTTP_UNAUTHORIZED);
        }

        assert(auth()->user() !== null);

        event(new UserLoggedIn(auth()->user()));

        /** @var int $minutes */
        $minutes = config('auth.token_timeout');

        $expiry = now()->addMinutes($minutes);

        $token = auth()->user()->createToken(
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
