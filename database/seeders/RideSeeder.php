<?php

namespace Database\Seeders;

use App\Models\Ride;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ride::factory()->count(5)->create();
    }
}
