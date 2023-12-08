<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{

    public function definition(): array
    {
        return [
            'userName' => $this->faker->name(),
            'dateTime' => $this->faker->dateTime(),
            'phone' => $this->faker->phoneNumber(),
            'whatsNumber' => $this->faker->phoneNumber,
            'guest' => $this->faker->numberBetween(1, 3),
            'note' => $this->faker->text(20),
            'price' => 15,
        ];
    }
}
