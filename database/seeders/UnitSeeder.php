<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::insert([
            [
                'unit_code' => 'BOX',
                'status' => '1',
                'created_at' => '2024-04-08',
                'encoded_by' => '1',
            ],
            [
                'unit_code' => 'PCS',
                'status' => '1',
                'created_at' => '2024-04-08',
                'encoded_by' => '1',
            ],
        ]);
    }
}
