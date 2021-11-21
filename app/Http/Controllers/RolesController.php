<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('backend.staffs.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_permission_group = DB::table('permission_name')->get();
        $permissions_groups_id = Permission::all();
        // dd($all_permissions);
        return view('backend.staffs.role.create', compact('permissions_groups_id', 'all_permission_group'));
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
            'name' => 'required|unique:roles|max:255',
            'permission'=> 'required'
        ],
        [
            'name.required'=> "Please give a role name",
            'name.unique'=> "This role name alread take",
            'name.max'=> "Please a role name character 255 under",
            'permission.required'=>'Something Permission must be select',
        ]);
        $role = Role::create(['name' => $request->name, 'guard_name'=>'admin']);
        $permissions = $request->input('permission');
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        session()->flash('success',  "Role Insert Successfull");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findById($id, 'admin');
        $all_permission_group = DB::table('permission_name')->get();
        $permissions_groups_id = Permission::all();
        return view('backend.staffs.role.edit', compact('role', 'permissions_groups_id', 'all_permission_group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'permission'=> 'required'
        ],
        [
            'name.required'=> "Please give a role name",
            'name.max'=> "Please a role name character 255 under",
            'permission.required'=>'Something Permission must be select',
        ]);
        $role = Role::findById($id, 'admin');
        $permissions = $request->input('permission');
        // dd($permissions);
        if(!empty($permissions)){
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }
        session()->flash('success',  "Role Update Successfull");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findById($id, 'admin');
        if (!is_null($role)) {
            $role->delete();
        }
        session()->flash('success', 'Role has been deleted !!');
        return back();
    }
}
