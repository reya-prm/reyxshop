<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view products',
            'create products',
            'edit products',
            'delete products',
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            'view reviews',
            'moderate reviews',
            'reply reviews',
            'view questions',
            'answer questions',
            'view chats',
            'respond chats',
            'manage settings',
            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $operatorRole = Role::firstOrCreate(['name' => 'operator']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // Admin gets all permissions
        $adminRole->syncPermissions(Permission::all());

        // Operator gets limited permissions
        $operatorRole->syncPermissions([
            'view products',
            'create products',
            'edit products',
            'view categories',
            'view reviews',
            'moderate reviews',
            'reply reviews',
            'view questions',
            'answer questions',
            'view chats',
            'respond chats',
        ]);

        // Customer gets no admin permissions (auth only)
        $customerRole->syncPermissions([]);
    }
}
