<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ride>
 */
class RideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'from' => $this->faker->address(),
            'to' => $this->faker->address(),
            'dateTime' => $this->faker->dateTime(),
            'price' => rand(200, 300) . '.99',
        ];
    }
}
