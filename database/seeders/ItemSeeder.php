<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::insert([
            [
                'category_id' => 1,
                'generic_name' => 'PARACETAMOL',
                'brand_name' => 'BIOGESIC',
                'status' => '1',
                'created_at' => '2024-04-08',
                'encoded_by' => '1',
            ],
        ]);
    }
}
