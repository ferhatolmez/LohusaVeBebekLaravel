<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view dashboard',
            'view lohusa forms',
            'create lohusa forms',
            'update lohusa forms',
            'delete lohusa forms',
            'export lohusa forms',
            'view bebek forms',
            'create bebek forms',
            'update bebek forms',
            'delete bebek forms',
            'export bebek forms',
            'issue api tokens',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $admin = Role::findOrCreate('admin', 'web');
        $ebe = Role::findOrCreate('ebe', 'web');
        $student = Role::findOrCreate('student', 'web');

        $admin->syncPermissions($permissions);
        $ebe->syncPermissions([
            'view dashboard',
            'view lohusa forms',
            'create lohusa forms',
            'update lohusa forms',
            'export lohusa forms',
            'view bebek forms',
            'create bebek forms',
            'update bebek forms',
            'export bebek forms',
            'issue api tokens',
        ]);
        $student->syncPermissions([
            'view dashboard',
            'view lohusa forms',
            'export lohusa forms',
            'view bebek forms',
            'export bebek forms',
            'issue api tokens',
        ]);

        $users = [
            ['name' => 'Admin Kullanici', 'email' => 'admin@example.com', 'role' => 'admin'],
            ['name' => 'Ebe Kullanici', 'email' => 'ebe@example.com', 'role' => 'ebe'],
            ['name' => 'Stajyer Ogrenci', 'email' => 'student@example.com', 'role' => 'student'],
        ];

        foreach ($users as $item) {
            $user = User::query()->updateOrCreate(
                ['email' => $item['email']],
                [
                    'name' => $item['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            $user->syncRoles([$item['role']]);
        }
    }
}
