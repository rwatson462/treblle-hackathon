<?php

namespace Tests\Feature\v1\Instance;

use App\Models\HeadlessModel;
use App\Models\HeadlessModelInstance;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateInstanceTest extends TestCase
{
    public function test_requiresAuth(): void
    {
        $response = $this->post(route('v1.model.instance.create', Uuid::uuid4()));

        $response->assertUnauthorized();

        $this->assertHeaders($response);
    }

    public function test_canCreateModelInstance(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create([
            'user_id' => $user->id,
            'name' => 'People',
            'attributes' => [
                'name' => 'required|string|max:255'
            ]
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('v1.model.instance.create', $model->id), [
                'name' => 'Steve',
            ]);

        $response
            ->assertCreated()
            ->assertJsonStructure([
                'message',
                'instance_id'
            ]);

        $instanceId = $response->json('instance_id');

        $this->assertHeaders($response);

        $this->assertDatabaseHas(HeadlessModelInstance::class, [
            'id' => $instanceId,
            'attributes' => json_encode(['name' => 'Steve']),
        ]);
    }

    public function test_cannotCreateInstanceForModelCreatedByOtherUser(): void
    {
        $user = User::factory()->create();

        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create([
            'attributes' => [
                'name' => 'required|string|max:255',
            ],
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('v1.model.instance.create', $model->id), [
                'name' => 'test',
            ]);

        $response
            ->assertForbidden();

        $this->assertHeaders($response);
    }

    public function test_validatorFailsWithInvalidData(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var HeadlessModel $model */
        $model = HeadlessModel::factory()->create([
            'user_id' => $user->id,
            'attributes' => [
                'name' => 'required|string|max:255',
            ],
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('v1.model.instance.create', $model->id), [
                'attribute_that_does_not_exist' => 'any_value',
            ]);

        $response->assertUnprocessable();

        $this->assertHeaders($response);
    }
}
