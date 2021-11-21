<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'guard_name', 'group_id'];
    // get permission name by group name
    public static function getpermissionsNameByGroupName($group_id){
        $permissions = Permission::select('name', 'id')->where('group_id', $group_id)->get();
        return $permissions;
    }
    public static function getpermissionGroup(){
        $permission_group = Permission::select('group_id as name')->groupBy('group_id')->get();
        return $permission_group;
    }
}
