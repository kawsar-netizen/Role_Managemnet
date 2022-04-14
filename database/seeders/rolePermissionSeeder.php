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
                       [
                        'group_name' => 'dashboard',
                        'permissions' =>[
                        //dashboard Permissions
                        'dashboard.view',
                        'dashboard.edit'
                        ]
                     
                        ],
                       [
                        'group_name' => 'blog',
                        'permissions' =>[
                        //Blog Permissions
                                        'blog.create',
                                        'blog.edit',
                                        'blog.view',
                                        'blog.delete',
                                        'blog.approve',
                        ]
                     
                        ],
                       [
                        'group_name' => 'admin',
                        'permissions' =>[
                         //admin Permissions
                                        'admin.create',
                                        'admin.edit',
                                        'admin.view',
                                        'admin.delete',
                                        'admin.approve',
                        ]
                     
                        ],
                       [
                        'group_name' => 'role',
                        'permissions' =>[
           
                                    //role Permissions
                                            'role.create',
                                            'role.edit',
                                            'role.view',
                                            'role.delete',
                                            'role.approve',
                        ]
                     
                        ],
                       [
                        'group_name' => 'profile',
                        'permissions' =>[
                //profile Permissions

                    'profile.edit',
                    'profile.view',
                        ]
                     
                        ],

                ];
        // create and assign permission
        for($i=0; $i<count($premissions); $i++){
                $permissionGroup = $premissions[$i]['group_name'];
                for($j=0; $j<count($premissions[$i]['permissions']); $j++){
                        $permission = Permission::create(['name' => $premissions[$i],'group_name'=>$permissionGroup]);
                        $roleSuperadmin->givePermissionTo($premissions[$i]['permissions'][$j]);
                        $permission->assignRole($roleSuperadmin);
                }

        }

    }
}
