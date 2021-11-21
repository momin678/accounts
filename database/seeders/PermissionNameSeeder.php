<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'staff',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'role',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'permission',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'product',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'category',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'brand',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'blog',
                'guard_name' => 'admin'
            ],
            
        ];
        for($i = 0; $i<count($permissions); $i++){
            $permission = DB::table('permission_name')->insert(['name'=>$permissions[$i]['name'], 'guard_name'=> $permissions[$i]['guard_name'] ]);
            
        }
    }
}
