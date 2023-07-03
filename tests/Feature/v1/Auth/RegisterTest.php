<?php

namespace Tests\Feature\v1\Auth;

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
}
