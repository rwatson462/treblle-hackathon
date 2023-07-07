<?php

namespace Tests\Unit\v1\Models;

use App\Models\HeadlessModelInstance;
use App\Models\User;
use Tests\TestCase;

class HeadlessModelInstanceTest extends TestCase
{
    public function test_canInstantiate(): void
    {
        $instance = HeadlessModelInstance::factory()->create();

        $this->assertInstanceOf(HeadlessModelInstance::class, $instance);
    }

    public function test_canGetUser(): void
    {
        /** @var HeadlessModelInstance $instance */
        $instance = HeadlessModelInstance::factory()->create();

        $this->assertInstanceOf(User::class, $instance->user);
    }
}
