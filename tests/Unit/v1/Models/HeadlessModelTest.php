<?php

namespace Tests\Unit\v1\Models;

use App\Models\HeadlessModel;
use App\Models\User;
use Tests\TestCase;

class HeadlessModelTest extends TestCase
{
    public function test_canInstantiate(): void
    {
        $model = HeadlessModel::create([
            'name' => 'test',
            'attributes' => [
                'name' => 'string|max:255'
            ],
            'user_id' => User::factory()->create()->id,
        ]);

        $this->assertInstanceOf(HeadlessModel::class, $model);
    }

    public function test_canGetModelInstances(): void
    {
        $model = HeadlessModel::factory()->hasInstances(3)->create();

        $this->assertCount(3, $model->instances);
    }
}
