<?php

namespace Database\Seeders;

use App\Models\Calendar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calendar::insert([
            [
                'id' => 1,
                'calendar' => 'Day/s',
            ], [
                'id' => 2,
                'calendar' => 'Month/s',
            ], [
                'id' => 3,
                'calendar' => 'Year/s',
            ]
        ]);
    }
}
