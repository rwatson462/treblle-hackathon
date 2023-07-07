<?php

namespace Tests\Unit\v1\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_canInstantiate(): void
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(User::class, $user);
        $this->assertIsString($user->id);
    }

    public function test_canGetHeadlessModels(): void
    {
        $user = User::factory()->hasModels(3)->create();

        $this->assertCount(3, $user->models);
    }
}
