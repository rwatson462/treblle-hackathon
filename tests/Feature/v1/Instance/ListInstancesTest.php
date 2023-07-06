<?php

namespace Tests\Feature\v1\Instance;

use App\Models\HeadlessModel;
use App\Models\HeadlessModelInstance;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class ListInstancesTest extends TestCase
{
    public function test_requiresAuth(): void
    {
        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create();

        $response = $this
            ->get(route('v1.model.instance', $model->id));

        $response->assertUnauthorized();

        $this->assertHeaders($response);
    }

    public function test_cannotGetListWhereModelDoesNotExist(): void
    {
        $response = $this
            ->actingAs(User::factory()->create())
            ->get(route('v1.model.instance', Uuid::uuid4()));

        $response
            ->assertNotFound();

        $this->assertHeaders($response);
    }

    public function test_canGetEmptyListOfModels(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('v1.model.instance', $model->id));

        $response
            ->assertOk()
            ->assertJsonCount(0, 'models');

        $this->assertHeaders($response);
    }

    public function test_canGetListOfModels(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create([
            'user_id' => $user->id,
            'attributes' => [
                'name' => 'required|string|max:255',
            ]
        ]);

        HeadlessModelInstance::factory()->create([
            'model_id' => $model->id,
            'attributes' => [
                'name' => fake()->name(),
            ]
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('v1.model.instance', $model->id));

        $response
            ->assertOk()
            ->assertJsonCount(1, 'models');

        $this->assertHeaders($response);
    }

    public function test_cannotGetModelInstancesForDifferentUser(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('v1.model.instance', $model->id));

        $response
            ->assertNotFound();

        $this->assertHeaders($response);
    }
}
