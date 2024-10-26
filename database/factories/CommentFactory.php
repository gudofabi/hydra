<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => $this->faker->text,
            'task_id' => $this->faker->randomElement([10, 11]),  // Randomly assign to task 10 or 11
            'user_id' => 1,  // Assuming a user with ID 1 exists
        ];
    }
}
