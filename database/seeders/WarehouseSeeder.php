<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warehouse::insert([
            [
                'warehouse_name' => 'WAREHOUSE 1',
                'warehouse_location' => 'ANGELES CITY',
                'status' => 1,
                'created_at' => '2024-04-08',
                'encoded_by' => '1',
            ],
            [
                'warehouse_name' => 'WAREHOUSE 2',
                'warehouse_location' => 'SAN FERNANDO',
                'status' => 1,
                'created_at' => '2024-04-08',
                'encoded_by' => '1',
            ],
        ]);
    }
}
