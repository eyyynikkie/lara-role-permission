<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'view posts',
            'manage roles',
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->syncPermissions([
            'create posts',
            'edit posts',
            'view posts',
            'publish posts',
        ]);

        $writer = Role::firstOrCreate(['name' => 'writer']);
        $writer->syncPermissions([
            'create posts',
            'edit posts',
            'view posts',
        ]);

        // Optional: Assign role to specific user (e.g., ID 1)
        $user = \App\Models\User::find(1);
        if ($user && !$user->hasRole('admin')) {
            $user->assignRole('admin');
        }
    }
}
