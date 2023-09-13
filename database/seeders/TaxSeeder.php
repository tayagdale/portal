<?php

namespace Database\Seeders;

use App\Models\Tax;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tax::insert([
            [
                'code' => 'VatInc',
                'rate' => '12',
                'effective_from' => '2023-01-01',
                'effective_to' => '2024-12-31',
            ], [
                'code' => 'VatEx',
                'rate' => '12',
                'effective_from' => '2023-01-01',
                'effective_to' => '2024-12-31',
            ]
        ]);
    }
}
