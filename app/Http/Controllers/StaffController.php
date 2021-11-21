<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_type', 'staff')->get();
        // dd($users);
        return view('backend.staffs.staff.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_permission_group = DB::table('permission_name')->get();
        $all_permission = Role::all();
        $permissions_groups_id = Permission::all();
        return view('backend.staffs.staff.create', compact('permissions_groups_id', 'all_permission_group','all_permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->role_id);
        $request->validate([
            'name'=>'required|max:100',
            'email'=>'required|unique:users|email|max:100',
            'password'=>'required|min:8'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;
        $user->password = Hash::make($request->password);
        $user->user_type = 'staff';
        $user->save();
        $user_id = $user->id;
        if($request->role_id || $request->permission_id){
           if($user_id){
                $staff = new Staff;
                $staff->user_id = $user->id;
                $staff->role_id = json_encode($request->role_id);
                $staff->permission_id = json_encode($request->permission_id);
                $staff->save();
                return back()->with('success', 'Staff create successfull');
            }
            return back()->with('error', 'somthing wrong ! Please try again');
        }
            return back()->with('error', 'please select role name OR Select permission name !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = User::find($id);
        $staff_id = Staff::where('user_id', $id)->first();
        $all_permission = Role::all();
        $all_permission_group = DB::table('permission_name')->get();
        $permissions_groups_id = Permission::all();
        return view('backend.staffs.staff.edit', compact('user_id','staff_id','permissions_groups_id', 'all_permission', 'all_permission_group'));
    }
    public function staff_edit($id){
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->role_id);
        $request->validate([
            'name'=>'required|max:100',
            'email'=>'required|email|max:100|unique:users,email,'.$id,
            'password'=>'nullable|min:8'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;
        if($request->password){
           $user->password = Hash::make($request->password); 
        }
        $user->user_type = 'staff';
        $user->save();
        if($request->role_id || $request->permission_id){
           if($id){
                $staff = Staff::where('user_id', $id)->first();
                $staff->role_id = json_encode($request->role_id);
                $staff->permission_id = json_encode($request->permission_id);
                $staff->save();
                return back()->with('success', 'Staff create Update Successfull');
            }
            return back()->with('warning', 'somthing wrong !');
        }
            return back()->with('error', 'please select role name OR Select permission name !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $id)
    {
        //
    }
}
