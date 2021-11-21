<?php

namespace Database\Seeders;

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
        // Create Role
        $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);
        $roleAdmin = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $roleAccount = Role::create(['name' => 'account', 'guard_name' => 'admin']);
        $roleManager = Role::create(['name' => 'manager', 'guard_name' => 'admin']);
        $roleStaff = Role::create(['name' => 'staff', 'guard_name' => 'admin']);
        // Permission list as array
        $permissions = [
            //Staff Permission
            [
                'permissions' => [
                    'staff.create',
                    'staff.view',
                    'staff.edit',
                    'staff.delete',
                    'staff.approve',
                ]
            ],
            //Role Permission
            [
                'permissions' => [
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',
                ]
            ],
            //Staff Permission Permission
            [
                'permissions' => [
                    'permission.create',
                    'permission.view',
                    'permission.edit',
                    'permission.delete',
                    'permission.approve',
                ]
            ],
            // Product Permission
            [
                'permissions' => [
                    'product.create',
                    'product.view',
                    'product.edit',
                    'product.delete',
                    'product.approve',
                ]
            ],
            //Category Permission
            [
                'permissions' => [
                    'category.create',
                    'category.view',
                    'category.edit',
                    'category.delete',
                    'category.approve',
                ]
            ],
            //Brand Permission
            [
                'permissions' => [
                    'brand.create',
                    'brand.view',
                    'brand.edit',
                    'brand.delete',
                    'brand.approve',
                ]
            ],
            //Blog Permission
            [
                'permissions' => [
                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                    'blog.approve',
                ]
            ],
            
        ];
        // Create and Assign Permissions
        for($i=0; $i<count($permissions); $i++){
            $permissionGrpup = $i+1;
            for($j=0; $j<count($permissions[$i]['permissions']); $j++){
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_id' => $permissionGrpup, 'guard_name' => 'admin']);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
    }
}
