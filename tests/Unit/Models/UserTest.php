<?php

namespace tests\Unit\Models;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_canInstantiate(): void
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(User::class, $user);
        $this->assertIsString($user->id);
    }
}
