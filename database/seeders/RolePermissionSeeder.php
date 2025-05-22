<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
    $admin = Role::create(['name' => 'admin', 'guard_name'=>'web']);
    $dosen = Role::create(['name' => 'dosen']);
    $mahasiswa = Role::create(['name' => 'mahasiswa']);

    // Permissions
    Permission::create(['name' => 'manage-users']);
    Permission::create(['name' => 'manage-kegiatan']);
    Permission::create(['name' => 'create-logentry']);
    Permission::create(['name' => 'view-logentry']);
    Permission::create(['name' => 'validate-logentry']);
    Permission::create(['name' => 'create-minicex']);
    Permission::create(['name' => 'evaluate-minicex']);
    Permission::create(['name' => 'take-test']);
    Permission::create(['name' => 'evaluate-test']);
    Permission::create(['name' => 'view-reports']);

    // Assign Permissions
    $admin->givePermissionTo([
        'manage-users',
        'manage-kegiatan',
        'view-logentry',
        'view-reports'
    ]);

    $dosen->givePermissionTo([
        'validate-logentry',
        'evaluate-minicex',
        'evaluate-test',
        'view-reports'
    ]);

    $mahasiswa->givePermissionTo([
        'create-logentry',
        'view-logentry',
        'create-minicex',
        'take-test'
    ]);

    // Create Admin User
    User::create([
        'name' => 'Admin',
        'email' => 'superadmin@logbook.com',
        'password' => bcrypt('adminjiwantb2025'),
    ])->assignRole('admin');
    }
}
