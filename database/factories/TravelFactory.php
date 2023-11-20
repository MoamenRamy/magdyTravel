<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travel>
 */
class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => fake()->numberBetween(1, 5),
            'name' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->paragraph(),
            'plan' => $this->faker->text(),
            'address' => $this->faker->address(),
            'price' => rand(200, 300) . '.99',
            'dateTime' => $this->faker->dateTime(),
            'period' => $this->faker->numberBetween(1, 7),
        ];
    }
}
