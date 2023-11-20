<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c1 = Currency::create([
            'name' => 'dollar',
            'symbol' => '$',
            'code' => 'USD',
            'price' => 1,
        ]);

        $c2 = Currency::create([
            'name' => 'euro',
            'symbol' => '€',
            'code' => 'EUR',
            'price' => 0.92,
        ]);
    }
}
