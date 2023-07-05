<?php

namespace Tests\Feature\v1\Headless;

use App\Models\HeadlessModel;
use App\Models\User;
use Tests\TestCase;

class CreateModelTest extends TestCase
{
    public function test_canCreateModel(): void
    {
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

        $response
            ->assertCreated()
            ->assertJsonStructure([
                'message',
                'model_id',
            ]);

        $this->assertHeaders($response);

        $this->assertDatabaseHas(HeadlessModel::class, [
            'name' => $modelData['name'],
            'attributes' => json_encode($modelData['attributes']),
            'user_id' => $user->id,
        ]);
    }

    public function test_cannotCreateSameModelTwice(): void
    {
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

        $response
            ->assertCreated()
            ->assertJsonStructure([
                'message',
                'model_id',
            ]);

        $this->assertHeaders($response);

        // Attempt to create the model again
        $response = $this
            ->actingAs($user)
            ->post(route('v1.model.create'), $modelData);

        $response->assertUnprocessable();

        $this->assertHeaders($response);
    }

    public function test_atLeastOneAttributeIsRequired(): void
    {
        // Make request with no attributes array
        $response = $this
            ->actingAs(User::factory()->create())
            ->post(route('v1.model.create'), [
                'name' => 'Dog',
            ]);

        $response
            ->assertUnprocessable();

        $this->assertHeaders($response);

        // Make request with empty attributes array
        $response = $this
            ->actingAs(User::factory()->create())
            ->post(route('v1.model.create'), [
                'name' => 'Dog',
                'attributes' => [],
            ]);

        $response
            ->assertUnprocessable();

        $this->assertHeaders($response);
    }

    public function test_cannotCreateModelWithInvalidValidatorParameters(): void
    {
        $response = $this
            ->actingAs(User::factory()->create())
            ->post(route('v1.model.create'), [
                'name' => 'Dog',
                'attributes' => [
                    'name' => 'lgkjhdfgjld',
                ],
            ]);

        $response
            ->assertUnprocessable();

        $this->assertHeaders($response);
    }

    public function test_requiresAuth(): void
    {
        $response = $this
            ->post(route('v1.model.create'), [
                'name' => 'Dog',
                'attributes' => [
                    'name' => 'string',
                ],
            ]);

        $response->assertUnauthorized();

        $this->assertHeaders($response);
    }
}
