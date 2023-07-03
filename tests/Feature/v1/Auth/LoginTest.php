<?php

namespace Tests\Feature\v1\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_canLogin(): void
    {
        $password = 'password';
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $response = $this
            ->post(route('v1.auth.login', [
                'email' => $user->email,
                'password' => $password,
            ]));

        $response
            ->assertOk()
            ->assertJsonFragment([
                'message' => 'success',
            ])
            ->assertJsonStructure([
                'message',
                'token',
                'expires',
            ]);

        $this->assertHeaders($response);
    }
}
