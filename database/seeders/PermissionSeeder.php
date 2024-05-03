<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    private $permissions = [
        'view-users',
        'create-users',
        'edit-users',
        'delete-users',
        'view-companies',
        'create-companies',
        'edit-companies',
        'delete-companies'
    ];

    public function run()
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        $adminPermissions = Permission::all();
        $userPermissions = Permission::where('name', 'view-companies')->get();

        $adminRole->syncPermissions($adminPermissions);
        $userRole->syncPermissions($userPermissions);
    }
}
