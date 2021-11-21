<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        $permissions_groups = DB::table('permission_name')->get();
        // dd($permissions_groups);
        return view('backend.staffs.permission.index', compact('permissions', 'permissions_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permission_add(Request $request, $id){
        $request->validate([
            'name' => 'required|max:100',
        ]);
        Permission::create(['name'=>$request->name, 'guard_name'=>'admin', 'group_id'=>$id]);
        return back()->with('success', 'New permission create successfull');
    }
    public function create()
    {
        return view('backend.staffs.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permission_name|max:255',
        ],
        [
            'required' => 'Group name must be requered',
            ]);
        if($request->permissionName == null){
            return back()->with('error', "permission name not by empty");
        }
        $permissionCreate = DB::table('permission_name')->insert(['name'=>$request->name, 'guard_name'=> 'admin']);
        if($permissionCreate){
            for($i = 0; $i<count($request->permissionName); $i++){
                $last_id = DB::table('permission_name')->select('id')->orderBy('id', 'desc')->first();
                $permission_name = $request->permissionName[$i];
                if($permission_name){
                    Permission::create(['name'=>$permission_name, 'guard_name'=>'admin', 'group_id'=>$last_id->id]);   
                }
            }
            
        }
        return back()->with('success', 'Group name and permission create successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission, $id)
    {
    }
    public function permission_group_edit(Request $request, $id){
        $permission_name_id = DB::table('permission_name')->find($id);
        $permissions = Permission::where('group_id', $id)->get();
        return view('backend.staffs.permission.edit', compact('permission_name_id', 'permissions'));
        // foreach ($permissions as $permission){
        //   Permission::where('id', $permission->id)->delete(); 
        // }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        // dd($permission->id);
        DB::table('permissions')->where('id', $permission->id)->update(['name' => $request->permissionName]);
        return back()->with('success', 'permission update successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        return back()->with('warning', 'Somthing Wrong');
    }
    // public function permission_group_delete(Request $request, $id){
    //     return back()->with('warning', 'Somthing Wrong');
    // }
}
