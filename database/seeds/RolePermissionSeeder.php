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
        //create Roles
        $rolesuperadmin = Role::create(['name' => 'superadmin']);
        $rolesysmanager = Role::create(['name' => 'sysmanager']);
        $rolesysowner = Role::create(['name' => 'sysowner']);
        $rolesalesman = Role::create(['name' => 'salesman']);
        $roleuser = Role::create(['name' => 'user']);

        //Permission list as a array
         //Permission list as a array
         $permissions = [
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    //Dashboard
                    'dashboard.view',
                    'dashboard.edit',
                ],
            ],
            [
                'group_name' => 'salesman',
                'permissions' => [
                    //salesman permissions
                    'salesman.create',
                    'salesman.view',
                    'salesman.edit',
                    'salesman.delete',
                    'salesman.approved',
                ],
            ],
            [
                'group_name' => 'sysmanager',
                'permissions' => [
                    //sysmanager permissions
                    'sysmanager.create',
                    'sysmanager.view',
                    'sysmanager.edit',
                    'sysmanager.delete',
                    'sysmanager.approved',
                ],
            ],
            [
                'group_name' => 'sysowner',
                'permissions' => [
                    //sysowner permissions
                    'sysowner.create',
                    'sysowner.view',
                    'sysowner.edit',
                    'sysowner.delete',
                ],
            ],
            [
                'group_name' => 'user',
                'permissions' => [
                    //user permissions
                    'user.create',
                    'user.view',
                    'user.edit',
                    'user.delete',
                    'user.approved',
                ],
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    //Role permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approved',
                ],
            ],
            [
                'group_name' => 'products',
                'permissions' => [
                    //products permissions
                    'products.create',
                    'products.view',
                    'products.edit',
                    'products.delete',
                    'products.approved',
                ],
            ],
            [
                'group_name' => 'category',
                'permissions' => [
                    //category permissions
                    'category.create',
                    'category.view',
                    'category.edit',
                    'category.delete',
                    'category.approved',
                ],
            ],
            [
                'group_name' => 'brands',
                'permissions' => [
                    //brands permissions
                    'brands.create',
                    'brands.view',
                    'brands.edit',
                    'brands.delete',
                    'brands.approved',
                ],
            ],
            [
                'group_name' => 'admin',
                'permissions' => [
                    //admin permissions
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                ],
            ],
            [
                'group_name' => 'profile',
                'permissions' => [
                    //Profile permissions
                    'profile.view',
                    'profile.edit',
                ],
            ],

        ];
        //create assign permission

        for ($i=0; $i < count($permissions); $i++) {
            // data fatch group wise
           $permissionGroup = $permissions[$i]['group_name'];
           for ($j=0; $j < count($permissions[$i]['permissions']); $j++) {
               // create permission
               $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
               $rolesuperadmin->givePermissionTo($permission);
               $permission->assignRole($rolesuperadmin);
           }
       }
    }
}
