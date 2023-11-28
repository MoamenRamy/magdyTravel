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
            // 'user_id' => $this->faker->numberBetween(1, 50),
            'travel_id' => $this->faker->numberBetween(1, 10),
            'bookDate' => $this->faker->dateTime(),
            'userAddress' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'price' => rand(200, 300) . '.99',
        ];
    }
}
