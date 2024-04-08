<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(InventoryStatusSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionToRoleSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(TaxSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserToRoleSeeder::class);
        $this->call(CalendarSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(TermSeeder::class);
        $this->call(WarehouseSeeder::class);
    }
}
