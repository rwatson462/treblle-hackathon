<?php

namespace Tests\Feature\v1\Auth;

use App\Models\User;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    public function test_canGetUserProfile(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('v1.auth.profile'));

        $response
            ->assertJsonFragment([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);

        $this->assertHeaders($response);
    }

    public function test_requiresAuth(): void
    {
        $response = $this
            ->get(route('v1.auth.profile'))
            ->assertUnauthorized();

        $this->assertHeaders($response);
    }
}
