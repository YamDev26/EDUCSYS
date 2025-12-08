<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Hourly;
use Illuminate\Database\Seeder;

class HourlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gestion dee Hourly Matin
        Hourly::create(['hourly' => '08:00', 'period' => '1']);
        Hourly::create(['hourly' => '09:00', 'period' => '1']);
        Hourly::create(['hourly' => '10:00', 'period' => '1']);
        Hourly::create(['hourly' => '11:00', 'period' => '1']);

        // Gestion dee Hourly Apres Midi
        Hourly::create(['hourly' => '14:30', 'period' => '2']);
        Hourly::create(['hourly' => '15:30', 'period' => '2']);
        Hourly::create(['hourly' => '16:30', 'period' => '2']);
        Hourly::create(['hourly' => '17:30', 'period' => '2']);

    }
}
