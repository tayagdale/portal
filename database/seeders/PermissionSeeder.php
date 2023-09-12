<?php

namespace Database\Seeders;

use App\Models\Permissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permissions::insert([
            [
                'permission_name' => 'Dashboard',
            ], [
                'permission_name' => 'Purchase Order',
            ], [
                'permission_name' => 'Inspection',
            ], [
                'permission_name' => 'Inventory',
            ], [
                'permission_name' => 'Order Slip',
            ], [
                'permission_name' => 'Sales Order',
            ], [
                'permission_name' => 'Delivery',
            ], [
                'permission_name' => 'Sales Invoice',
            ], [
                'permission_name' => 'Incoming Payment',
            ], [
                'permission_name' => 'Outgoing Payment',
            ], [
                'permission_name' => 'Categories',
            ], [
                'permission_name' => 'Inventory Status',
            ], [
                'permission_name' => 'Warehouse',
            ], [
                'permission_name' => 'Items',
            ], [
                'permission_name' => 'Unit of Measure',
            ], [
                'permission_name' => 'Customers',
            ], [
                'permission_name' => 'Suppliers',
            ], [
                'permission_name' => 'Users',
            ], [
                'permission_name' => 'Roles',
            ], [
                'permission_name' => 'Permissions',
            ], [
                'permission_name' => 'Tax',
            ], [
                'permission_name' => 'Terms',
            ]
        ]);
    }
}
