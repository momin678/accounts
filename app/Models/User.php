<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'user_type',
        'role',
        'password',
        'avatar',
        'provider_id',
        'provider',
        'access_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function getpermissionGroup(){
        $permission_group = DB::table('permissions')->select('group_id as name')->groupBy('group_id')->get();
        return $permission_group;
    }
    public static function getpermissionsByGroupName($group_name){
        $permissions = DB::table('permissions')->select('name', 'id')->where('group_id', $group_name)->get();
        return $permissions;
    }
    public static function roleHasPermissions($role, $permissions){
        $hasPermission = true;
        foreach($permissions as $permission){
            if(!$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }
    
    public static function checkPermission(){
        if(Auth::user()->user_type == "staff"){
            $user_id = Auth::user()->id;
            $getStaffInfo = Staff::where('user_id', $user_id)->first();
            $getStaffRole = json_decode($getStaffInfo->role_id);
            $getStaffpermission = json_decode($getStaffInfo->permission_id);
            $totalPermissnion = [];
            if($getStaffRole){
                for($i=0; $i<count($getStaffRole); $i++){
                    $permission_id = DB::table('role_has_permissions')->where('role_id', $getStaffRole[$i])->get();
                    foreach($permission_id as $permission){
                        if(in_array($permission->permission_id, $totalPermissnion) == null){
                            array_push($totalPermissnion,$permission->permission_id);
                        }
                    }
                }
            }
            if($getStaffpermission){
                for($i=0; $i<count($getStaffpermission); $i++){
                    if(in_array( $getStaffpermission[$i],$totalPermissnion) == null){
                        array_push( $totalPermissnion, $getStaffpermission[$i]);
                    }
                }
            }
            return $totalPermissnion;
        }
        
    }
    public function staff()
    {
    return $this->hasOne(Staff::class);
    }
    
    
    
    
}
