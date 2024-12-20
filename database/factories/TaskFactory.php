<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->text(),
            'reminder_at' => fake()->dateTime(),
            'user_id' => User::factory(),
            'due_at' => fake()->dateTime(),
            'meta' => fake()->text(),
            'additional_info' => fake()->text(),
        ];
    }
}
