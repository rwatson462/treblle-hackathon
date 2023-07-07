<?php

namespace Tests\Feature\v1\Auth;

use App\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_canRegisterUser(): void
    {
        $response = $this->post(route('v1.auth.register'), [
            'email' => 'user@example.com',
            'name' => 'Test user',
            'password' => 'password',
        ]);

        $response->assertCreated();

        $this->assertHeaders($response);
    }

    public function test_cannotRegisterAnExistingUser(): void
    {
        User::factory()->create([
            'email' => 'user@example.com',
        ]);

        $response = $this
            ->post(route('v1.auth.register'), [
                'email' => 'user@example.com',
                'name' => fake()->name(),
                'password' => fake()->password(),
            ]);

        $response->assertUnprocessable();

        $this->assertHeaders($response);
    }
}
