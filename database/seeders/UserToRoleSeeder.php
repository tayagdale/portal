<?php

namespace Database\Seeders;

use App\Models\UserToRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserToRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserToRole::insert([
            [
                'user_id' => '1',
                'role_id' => '1',
            ]
        ]);
    }
}
