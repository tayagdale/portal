<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Dale John Tayag',
            'email' => 'tayagdale@gmail.com',
            'username' => 'tayagdale',
            'password' => 'qweqwe123'
            // Add more columns and values as needed
        ]);
    }
}
