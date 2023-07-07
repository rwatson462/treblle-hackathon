<?php

namespace Tests\Feature\v1\Instance;

use App\Models\HeadlessModelInstance;
use App\Models\User;
use Tests\TestCase;

class DeleteInstanceTest extends TestCase
{

    public function test_requiresAuth(): void
    {
        /** @var HeadlessModelInstance $instance */
        $instance = HeadlessModelInstance::factory()->create();

        $response = $this->delete(route('v1.model.instance.delete', [
            'uuid' => $instance->model->id,
            'instance_uuid' => $instance->id,
        ]));

        $response->assertUnauthorized();

        $this->assertHeaders($response);
    }

    public function test_canDeleteInstance(): void
    {
        /** @var HeadlessModelInstance $instance */
        $instance = HeadlessModelInstance::factory()->create();

        $response = $this
            ->actingAs($instance->user)
            ->delete(route('v1.model.instance.delete', [
                'uuid' => $instance->model->id,
                'instance_uuid' => $instance->id,
            ]));

        $response
            ->assertOk();

        $this->assertHeaders($response);

        $this->assertDatabaseMissing(HeadlessModelInstance::class, [
            'id' => $instance->id,
        ]);
    }

    public function test_cannotDeleteOtherUsersInstance(): void
    {
        // We have to load the model here because once we "act as" another user,
        // the Scope kicks in, and we can't access the model

        /** @var HeadlessModelInstance $instance */
        $instance = HeadlessModelInstance::factory()->create()->load('model');

        $response = $this
            ->actingAs(User::factory()->create())
            ->delete(route('v1.model.instance.delete', [
                'uuid' => $instance->model->id,
                'instance_uuid' => $instance->id,
            ]));

        $response
            ->assertNotFound();

        $this->assertHeaders($response);
    }
}
