<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
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

        // Customer gets no admin permissions (only for auth)
        $customerRole->syncPermissions([]);
    }
}
