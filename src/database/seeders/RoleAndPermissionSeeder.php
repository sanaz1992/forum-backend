<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::where('name', config('permission.default_roles'))->count() < 1) {
            foreach (config('permission.default_roles') as $role) {
                Role::create(['name' => $role]);
            }
        }
        if (Permission::where('name', config('permission.default_permissions'))->count() < 1) {
            foreach (config('permission.default_permissions') as $permission) {
                Permission::create(['name' => $permission]);
            }
        }


    }
}
