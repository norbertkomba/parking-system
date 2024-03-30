<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        $user = User::create([
            'full_name' => 'Hafidh',
            'username' => 'admin',
            'password' => Hash::make('admin@123'),
        ]);
        $user->assignRole(Role::all());
        $user->givePermissionTo(Permission::all());
        Schema::enableForeignKeyConstraints();
    }
}
