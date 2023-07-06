<?php

namespace Database\Factories;

use App\Models\HeadlessModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HeadlessModelInstance>
 */
class HeadlessModelInstanceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'model_id' => HeadlessModel::factory(),
            'attributes' => [],
        ];
    }
}
