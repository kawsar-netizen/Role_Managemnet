<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        //permissiono list as array
        $premission = [
            //Blog Permissions
                    'blog.create',
                    'blog.edit',
                    'blog.show',
                    'blog.delete',
                    'blog.approve',
        ];
        //assign permission
    }
}
