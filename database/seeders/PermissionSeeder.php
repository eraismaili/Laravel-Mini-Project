<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    private $permissions = [
        'view-dashboard'

    ];

    public function run()
    {

        $adminRole = Role::where('name', 'admin')->first();

        $adminPermissions = Permission::all();

        $adminRole->syncPermissions($adminPermissions);
    }
}
