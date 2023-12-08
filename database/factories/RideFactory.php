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
            'destination_id' => $this->faker->numberBetween(1, 50),
            'name' => $this->faker->name(),
            'from' => $this->faker->address(),
            'to' => $this->faker->address(),
            'dateTime' => $this->faker->dateTimeBetween('now', '+30 days'),
            'guest' => $this->faker->numberBetween(1, 4),
            'phoneNumber' => $this->faker->phoneNumber,
            'whatsNumber' => $this->faker->phoneNumber,
            'note' => $this->faker->text(50),
            'price' => rand(200, 300) . '.99',
        ];
    }
}
