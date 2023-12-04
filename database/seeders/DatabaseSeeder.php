<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CurrencySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TravelSeeder::class);
        $this->call(DestinationSeeder::class);
        $this->call(RideSeeder::class);
        $this->call(PhotoSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(UserTravelSeeder::class);
        $this->call(ChangeTripPriceSeeder::class);
        $this->call(TripSeeder::class);
    }
}
