<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HeadlessModel>
 */
class HeadlessModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->word(),
            'attributes' => [
                fake()->word() => 'required',  // basic validation that this attribute is required
            ],
        ];
    }
}
