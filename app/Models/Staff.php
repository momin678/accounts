<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\Staff;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staff';
    
    public static function getStaffId($user_id){
        $get_user_id = Staff::where('user_id', $user_id)->first();
        return $get_user_id;
    }
    public static function getRoleName($role_id){
        $get_role_name = Role::where('id', $role_id)->first();
        return $get_role_name;
    }
    public static function getPermissionName($permission_id){
        $getPermissionName = DB::table('permissions')->where('id', $permission_id)->first();
        return $getPermissionName;
    }
    public function role(){
    return $this->belongsTo(Role::class);
    }
}
