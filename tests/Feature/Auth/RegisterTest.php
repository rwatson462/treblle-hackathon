<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_canRegisterUser(): void
    {
        $response = $this->post(route('auth.register'), [
            'email' => 'user@example.com',
            'name' => 'Test user',
            'password' => 'password',
        ]);

        $response->assertCreated();
    }
}
