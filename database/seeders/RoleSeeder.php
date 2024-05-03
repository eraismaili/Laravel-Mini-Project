<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo(['view-companies']);

    }
}
