<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'category_name' => 'MEDICINE',
                'created_at' => '2024-04-08',
                'encoded_by' => '1',
            ],
        ]);
    }
}
