<?php

namespace Tests\Feature\v1\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function test_canLogOut(): void
    {
        $password = 'password';
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $response = $this->post(route('v1.auth.login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertJsonStructure([
            'token',
        ]);

        $response = $this
            ->withHeader('Authorization', 'Bearer ' . $response->json('token'))
            ->post(route('v1.auth.logout'));

        $this->assertEquals(0, $user->tokens()->count());

        // make authenticated request, expect unauthorised response
        $this->assertHeaders($response);
    }

    public function test_requiresAuth(): void
    {
        $this->post(route('v1.auth.logout'))
            ->assertUnauthorized();
    }
}
