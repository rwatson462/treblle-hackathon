<?php

namespace Tests\Feature\v1\Headless;

use App\Models\HeadlessModel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListModelTest extends TestCase
{
    public function test_requiresAuth(): void
    {
        $response = $this
            ->get(route('v1.model.list'));

        $response->assertUnauthorized();

        $this->assertHeaders($response);
    }

    public function test_canListZeroModels(): void
    {
        $response = $this
            ->actingAs(User::factory()->create())
            ->get(route('v1.model.list'));

        $response
            ->assertOk()
            ->assertJsonCount(0, 'models');

        $this->assertHeaders($response);
    }

    public function test_canListModels(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('v1.model.list'));

        $response
            ->assertOk()
            ->assertJsonCount(1, 'models')
            ->assertJsonStructure([
                'models' => [
                    ['id', 'name'],
                ],
            ])
            ->assertJsonFragment([
                'models' => [
                    [
                        'id' => $model->id,
                        'name' => $model->name,
                    ]
                ],
            ]);

        $this->assertHeaders($response);
    }

    public function test_cannotSeeOtherUsersModels(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create([
            'user_id' => $user->id,
        ]);

        // This model will not be linked to our user
        HeadlessModel::factory()->create();

        // Confirm we definitely have 2 models in the database
        $this->assertDatabaseCount(HeadlessModel::class, 2);

        $response = $this
            ->actingAs($user)
            ->get(route('v1.model.list'));

        // Assert that only 1 model was returned, and it's the one we expect
        $response
            ->assertOk()
            ->assertJsonCount(1, 'models')
            ->assertJsonFragment([
                'models' => [
                    [
                        'id' => $model->id,
                        'name' => $model->name,
                    ]
                ],
            ]);;

        $this->assertHeaders($response);
    }
}
