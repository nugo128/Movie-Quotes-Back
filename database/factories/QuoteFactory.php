<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'movie_id'   => Movie::factory(),
			'quote'      => fake()->unique()->sentence(),
			'user_id'    => User::factory(),
			'thumbnail'  => $this->faker->imageUrl(),
			'created_at' => now(),
		];
	}
}
