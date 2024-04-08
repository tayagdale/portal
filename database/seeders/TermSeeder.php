<?php

namespace Database\Seeders;

use App\Models\Terms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Terms::insert([
            [
                'terms' => 5,
                'calendar_id' => 3,
                'status' => 1,
                'created_at' => '2024-04-08',
            ],
            [
                'terms' => 30,
                'calendar_id' => 1,
                'status' => 1,
                'created_at' => '2024-04-08',
            ],
        ]);
    }
}
