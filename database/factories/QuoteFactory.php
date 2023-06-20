<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

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
		$quotes = [
			'en' => fake()->unique()->sentence(),
			'ka' => Faker::create('ka_GE')->realText(20),
		];
		return [
			'movie_id'   => Movie::factory(),
			'quote'      => json_encode($quotes),
			'user_id'    => User::factory(),
			'thumbnail'  => $this->faker->imageUrl(),
			'created_at' => now(),
		];
	}
}
