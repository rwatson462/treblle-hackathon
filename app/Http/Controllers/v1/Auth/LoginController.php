<?php

namespace App\Http\Controllers\v1\Auth;

use App\DataTransferObjects\Requests\LoginRequestDto;
use App\Events\v1\Auth\UserLoggedIn;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{
    public function __invoke(LoginRequestDto $request): JsonResponse
    {
        if (! Auth::attempt($request->toArray())) {
            return new JsonResponse([
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

        return new JsonResponse([
            'message' => 'success',
            'token' => $token->plainTextToken,
            'expires' => $expiry,
        ]);
    }
}
