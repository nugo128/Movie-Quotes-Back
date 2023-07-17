<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

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
		$movie = [
			'en' => fake()->unique()->sentence(),
			'ka' => Faker::create('ka_GE')->realText(20),
		];
		return [
			'title'        => json_encode($movie),
			'user_id'      => User::factory(),
			'director'     => fake()->name(),
			'description'  => fake()->text(),
			'year'         => fake()->year(),
			'thumbnail'    => $this->faker->imageUrl(),
			'created_at'   => now(),
		];
	}
}
