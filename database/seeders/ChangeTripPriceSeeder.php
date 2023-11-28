<?php

namespace Database\Seeders;

use App\Models\ChangeTripPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChangeTripPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $price1 = ChangeTripPrice::create([
            'price' => '15.00',
        ]);
    }
}
