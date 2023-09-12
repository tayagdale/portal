<?php

namespace Database\Seeders;

use App\Models\InventoryStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InventoryStatus::insert([
            [
                'status_name' => 'In-stock',
                'status_value' => '100'
            ], [
                'status_name' => 'Warning',
                'status_value' => '30',
            ], [
                'status_name' => 'Out of Stock',
                'status_value' => '0',
            ]

        ]);
    }
}
