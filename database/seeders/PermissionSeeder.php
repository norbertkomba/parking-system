<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Role::truncate();
        Permission::truncate();
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'manage group', 'guard_name' => 'web', 'group_name' => 'Permission']);
        Permission::create(['name' => 'assign group', 'guard_name' => 'web', 'group_name' => 'Permission']);
        Permission::create(['name' => 'update group', 'guard_name' => 'web', 'group_name' => 'Permission']);
        Permission::create(['name' => 'create group', 'guard_name' => 'web', 'group_name' => 'Permission']);
        Permission::create(['name' => 'delete group', 'guard_name' => 'web', 'group_name' => 'Permission']);

        Permission::create(['name' => 'delete data', 'guard_name' => 'web', 'group_name' => 'Control']);
        Permission::create(['name' => 'change status', 'guard_name' => 'web', 'group_name' => 'Control']);
        Permission::create(['name' => 'reset password', 'guard_name' => 'web', 'group_name' => 'Control']);

        Permission::create(['name' => 'manage user', 'guard_name' => 'web', 'group_name' => 'Users']);
        Permission::create(['name' => 'update user', 'guard_name' => 'web', 'group_name' => 'Users']);
        Permission::create(['name' => 'create user', 'guard_name' => 'web', 'group_name' => 'Users']);
        Permission::create(['name' => 'delete user', 'guard_name' => 'web', 'group_name' => 'Users']);

        Permission::create(['name' => 'manage device', 'guard_name' => 'web', 'group_name' => 'Device']);
        Permission::create(['name' => 'update device', 'guard_name' => 'web', 'group_name' => 'Device']);
        Permission::create(['name' => 'create device', 'guard_name' => 'web', 'group_name' => 'Device']);
        Permission::create(['name' => 'delete device', 'guard_name' => 'web', 'group_name' => 'Device']);

        Permission::create(['name' => 'manage category', 'guard_name' => 'web', 'group_name' => 'Vehicle Category']);
        Permission::create(['name' => 'update category', 'guard_name' => 'web', 'group_name' => 'Vehicle Category']);
        Permission::create(['name' => 'create category', 'guard_name' => 'web', 'group_name' => 'Vehicle Category']);
        Permission::create(['name' => 'delete category', 'guard_name' => 'web', 'group_name' => 'Vehicle Category']);

        Permission::create(['name' => 'manage card', 'guard_name' => 'web', 'group_name' => 'Vehicle Card']);
        Permission::create(['name' => 'update card', 'guard_name' => 'web', 'group_name' => 'Vehicle Card']);
        Permission::create(['name' => 'create card', 'guard_name' => 'web', 'group_name' => 'Vehicle Card']);
        Permission::create(['name' => 'delete card', 'guard_name' => 'web', 'group_name' => 'Vehicle Card']);

        Permission::create(['name' => 'manage rate', 'guard_name' => 'web', 'group_name' => 'Rates']);
        Permission::create(['name' => 'update rate', 'guard_name' => 'web', 'group_name' => 'Rates']);
        Permission::create(['name' => 'create rate', 'guard_name' => 'web', 'group_name' => 'Rates']);
        Permission::create(['name' => 'delete rate', 'guard_name' => 'web', 'group_name' => 'Rates']);

        Permission::create(['name' => 'manage vehicle', 'guard_name' => 'web', 'group_name' => 'Vehicle']);
        Permission::create(['name' => 'update vehicle', 'guard_name' => 'web', 'group_name' => 'Vehicle']);
        Permission::create(['name' => 'create vehicle', 'guard_name' => 'web', 'group_name' => 'Vehicle']);
        Permission::create(['name' => 'delete vehicle', 'guard_name' => 'web', 'group_name' => 'Vehicle']);

        Role::create(['name' => 'Super Administrator'])->givePermissionTo(Permission::all());

        Schema::enableForeignKeyConstraints();
    }
}
