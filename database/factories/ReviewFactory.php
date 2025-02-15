<?php

namespace Database\Factories;

use App\Models\Response;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'response_id'   => Response::factory(),
            'reviewer_id'   => User::factory(),
            'score'         => fake()->numberBetween(1, 10),
            'feedback'      => fake()->sentence(),
        ];
    }
}
