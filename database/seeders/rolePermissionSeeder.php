<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class rolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create roles

        $roleSuperadmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);

        //permissiono list as array

        $premissions = [
            //dashboard Permissions
                    'dashboard.view',
            //Blog Permissions
                    'blog.create',
                    'blog.edit',
                    'blog.view',
                    'blog.delete',
                    'blog.approve',
            //admin Permissions
                    'admin.create',
                    'admin.edit',
                    'admin.view',
                    'admin.delete',
                    'admin.approve',
            //role Permissions
                    'role.create',
                    'role.edit',
                    'role.view',
                    'role.delete',
                    'role.approve',

            //profile Permissions

                    'profile.edit',
                    'profile.view',
        ];

        // create and assign permission
        for($i=0; $i<count($premissions); $i++){
            $permission = Permission::create(['name' => $premissions[$i]]);
            $roleSuperadmin->givePermissionTo($permission);
            $permission->assignRole($roleSuperadmin);
        }

    }
}
