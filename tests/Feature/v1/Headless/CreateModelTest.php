<?php

namespace Tests\Feature\v1\Headless;

use App\Models\User;
use Tests\TestCase;

class CreateModelTest extends TestCase
{
    public function test_canCreateModel(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('v1.model.create', [
                'name' => 'Dog',
                'attributes' => [
                    'name' => 'required|string|max:255',
                    'size' => 'required|string|in:small,medium,large',
                    'breed' => 'required|string|max:255',
                ],
            ]));

        $response
            ->assertCreated()
            ->assertJsonStructure([
                'message',
                'model_id',
            ]);

        $this->assertHeaders($response);
    }
}