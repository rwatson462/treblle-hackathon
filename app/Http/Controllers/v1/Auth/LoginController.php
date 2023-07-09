<?php

namespace App\Http\Controllers\v1\Auth;

use App\DataTransferObjects\Requests\Auth\LoginRequestDto;
use App\Events\v1\Auth\UserLoggedIn;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function authUser;

class LoginController
{
    public function __invoke(LoginRequestDto $data): JsonResponse
    {
        if (! Auth::attempt($data->toArray())) {
            return new JsonResponse([
                'message' => 'invalid email/password combination',
            ], Response::HTTP_UNAUTHORIZED);
        }

        event(new UserLoggedIn(authUser()));

        /** @var int $minutes */
        $minutes = config('auth.token_timeout');

        $expiry = now()->addMinutes($minutes);

        $token = authUser()->createToken(
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
