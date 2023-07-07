<?php

namespace Tests\Feature\v1\Instance;

use App\Models\HeadlessModel;
use App\Models\HeadlessModelInstance;
use App\Models\User;
use Tests\TestCase;

class GetInstanceTest extends TestCase
{
    public function test_requiresAuth(): void
    {
        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create();

        /** @var HeadlessModelInstance $instance */
        $instance = HeadlessModelInstance::factory()->create([
            'model_id' => $model->id,
        ]);

        $response = $this
            ->get(route('v1.model.instance.get', [
                $model->id,
                $instance->id
            ]));

        $response->assertUnauthorized();

        $this->assertHeaders($response);
    }

    public function test_canGetModelInstance(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create([
            'user_id' => $user->id,
        ]);

        /** @var HeadlessModelInstance $instance */
        $instance = HeadlessModelInstance::factory()->create([
            'model_id' => $model->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('v1.model.instance.get', [
                $model->id,
                $instance->id
            ]));

        $response
            ->assertOk()
            ->assertJsonFragment([
                'instance' => [
                    'id' => $instance->id,
                ],
                'model' => [
                    'id' => $model->id,
                    'name' => $model->name,
                ]
            ]);

        $this->assertHeaders($response);
    }

    public function test_cannotGetModelInstanceForOtherUsersModel(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create();

        /** @var HeadlessModelInstance $instance */
        $instance = HeadlessModelInstance::factory()->create([
            'model_id' => $model->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('v1.model.instance.get', [
                $model->id,
                $instance->id
            ]));

        $response
            ->assertNotFound();

        $this->assertHeaders($response);
    }
}
