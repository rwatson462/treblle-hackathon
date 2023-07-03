<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Responses\AppResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        // Check if user already exists
        if (User::where('email', $request->email)->exists()) {
            return new AppResponse([
                'message' => 'error registering user',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create user
        $user = User::create($request->validated());

        // Return success
        return new AppResponse([
            'message' => 'success',
            'user_id' => $user->id,
        ], Response::HTTP_CREATED);
    }
}
