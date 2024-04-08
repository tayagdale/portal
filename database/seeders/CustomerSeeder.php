<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::insert([
            [
                'customer_code' => 'ACH',
                'description' => 'ANGELES CITY HALL',
                'address' => 'ANGELES CITY',
                'contact_no' => '09256483255',
                'contact_person' => 'MAYOR CARMELO LAZATIN',
                'position' => 'Mayor',
                'created_at' => '2024-04-08',
                'encoded_by' => '1',
            ],
        ]);
    }
}
