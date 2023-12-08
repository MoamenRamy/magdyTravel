<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserTravel>
 */
class UserTravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'travel_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name(),
            'count' => $this->faker->numberBetween(1, 15),
            'bookDate' => $this->faker->dateTime(),
            'userAddress' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'whatsNumber' => $this->faker->phoneNumber,
            'price' => rand(200, 300) . '.99',
        ];
    }
}
