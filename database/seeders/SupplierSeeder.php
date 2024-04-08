<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::insert([
            [
                'supplier_code' => 'AUF',
                'description' => 'ANGELES UNIVERSITY FOUNDATION MEDICAL CENTER',
                'address' => 'ANGELES CITY',
                'contact_no' => '09256483255',
                'contact_person' => 'DR. JOHN SMITH',
                'position' => 'Doctor',
                'created_at' => '2024-04-08',
                'encoded_by' => '1',
            ], 
        ]);
    }
}
