<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'title'     => fake()->unique()->sentence(),
			'user_id'   => User::factory(),
			'director'  => fake()->name(),
			'year'      => fake()->year(),
			'thumbnail' => $this->faker->imageUrl(),
			'created_at'=> now(),
		];
	}
}
