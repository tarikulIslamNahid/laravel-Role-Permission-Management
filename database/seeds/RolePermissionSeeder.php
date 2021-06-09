<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);


        // Permissions List
        $permissions =[

            //dashboard
            [
                'group_name' => 'dashboard',
                'permissions'=>[
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],

            //Blog permissions
            [
                'group_name' => 'blog',
                'permissions'=>[
                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                    'blog.approve',

                ]
            ],


            //Admin permissions
            [
                'group_name' => 'admin',
                'permissions'=>[
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ]
            ],


            //Role permissions
            [
                'group_name' => 'role',
                'permissions'=>[
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',
                ]
            ],


            //profile permissions
            [
                'group_name' => 'profile',
                'permissions'=>[
                    'profile.view',
                    'profile.edit',
                ]
            ],

        ];

        // create and assigned permissions
        for ($i=0; $i < count($permissions) ; $i++) {
        $groupPermissions=$permissions[$i]['group_name'];
        for ($j=0; $j < count($permissions[$i]['permissions']); $j++) {
        //create permissions
        $permission = Permission::create([
            'name' => $permissions[$i]['permissions'][$j],
            'group_name' => $groupPermissions,
            ]);

        $roleSuperAdmin->givePermissionTo($permission);
        $permission->assignRole($roleSuperAdmin);
        }

        }

    }
}
