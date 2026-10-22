<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

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
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $operator = Role::firstOrCreate(['name' => 'operator']);

        // Admin has all permissions
        $admin->givePermissionTo(Permission::all());

        // Operator has limited permissions (no delete, no manage users/settings)
        $operator->givePermissionTo([
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

        // Assign roles to existing users
        $adminUser = User::where('email', 'admin@reyxshop.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }

        $operatorUser = User::where('email', 'operator@reyxshop.com')->first();
        if ($operatorUser) {
            $operatorUser->assignRole('operator');
        }
    }
}
