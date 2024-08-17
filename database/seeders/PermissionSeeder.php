<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[
        'add_users',
        'update_users',
        'show_users',
        'delete_users',
        'add_categories',
        'update_categories',
        'delete_categories',
        'show_categories',
        'add_items',
        'update_items',
        'delete_items',
        'show_items',
        'add_orders',
        'update_orders',
        'delete_orders',
        'show_orders',
        'manage_settings',
        'view_dashboard',
        'add_admins',
        'update_admins',
        'show_admins',
        'delete_admins',
        'add_roles',
        'update_roles',
        'show_roles',
        'delete_roles',
        'add_permissions',
        'update_permissions',
        'show_permissions',
        'delete_permissions',
        'add_countries',
        'update_countries',
        'show_countries',
        'delete_countries','add_cities',
        'update_cities',
        'show_cities',
        'delete_cities',
        'add_currencies',
        'update_currencies',
        'show_currencies',
        'delete_currencies',

        ];
        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'name' => $permission,
                'guard_name'=>'admin',
            ]);
        }
    }
}
