<?php

namespace Database\Seeders;

use App\Models\UserTravel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserTravel::factory()->count(30)->create();
    }
}
