<?php

namespace Tests\Feature\v1\Headless;

use App\Models\HeadlessModel;
use App\Models\User;
use Tests\TestCase;

class DeleteModelTest extends TestCase
{
    public function test_canDeleteModel(): void
    {
        // Create model
        $user = User::factory()->create();

        $modelData = [
            'name' => 'Dog',
            'attributes' => [
                'name' => 'required|string|max:255',
                'size' => 'required|string|in:small,medium,large',
                'breed' => 'required|string|max:255',
            ]
        ];

        $response = $this
            ->actingAs($user)
            ->post(route('v1.model.create'), $modelData);

        // Assert
        $response
            ->assertCreated()
            ->assertJsonStructure([
                'message',
                'model_id',
            ]);

        $modelId = $response->json('model_id');

        $this->assertHeaders($response);

        // Delete model
        $response = $this
            ->actingAs($user)
            ->delete(route('v1.model.delete'), [
                'model_id' => $modelId,
            ]);

        // Assert
        $response
            ->assertOk();

        $this->assertHeaders($response);

        // Check database
        $this->assertDatabaseMissing(HeadlessModel::class, [
            'id' => $modelId,
            'user_id' => $user->id,
            'name' => $modelData['name'],
        ]);
    }
}
