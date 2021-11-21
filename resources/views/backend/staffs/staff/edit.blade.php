@extends('backend.layouts.app')
@section('content')
<style>
    .form-check-label {
        text-transform: capitalize;
    }
    .bg_color{
        background-color: #98d4c463 !important;
    }
</style>
<div class="aiz-titlebar text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">Staff Edit</h1>
        </div>
        <div class="col text-right">
            <a href="{{route('staff.index')}}" class="btn btn-circle btn-info">
                <span>Return Back</span>
            </a>
        </div>
    </div>
</div>
@include('errors.error_massege')
<div class="card">
    <form action="{{route('staff.update', $user_id->id)}}" method="POST">
        @method("PUT")
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Staff Name</label>
                        <input type="text" class="form-control" placeholder="Staff name" name='name' value="{{$user_id->name}}">
                    </div>
                    <div class="form-group">
                        <label>Staff Email</label> 
                        <input class="form-control" type="email" name='email' placeholder="Staff email" value="{{$user_id->email}}">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" placeholder="Staff number" name='number' value="{{$user_id->number}}">
                    </div>
                    <div class="form-group">
                        <label>Staff password</label> 
                        <input class="form-control" type="password" name='password'  placeholder="password">
                    </div>
                    
                    @php $role_id = json_decode($staff_id->role_id); @endphp
                    <div class="form-group">
                        <label>Staff Role</label>
                        <select class="form-control multiple_select" multiple name="role_id[]">
                            @foreach ($all_permission as $permission)
                                <option value="{{$permission->id}}" @if( $role_id && in_array($permission->id,$role_id)) selected @endif >{{$permission->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <label>Extra-permission</label> 
                    <div class="row">
                        @php $i = 1; @endphp
                        @foreach ($all_permission_group as $group)
                        @php
                            $role_id = json_decode($staff_id->permission_id);
                            $permissions = App\Models\Permission::getpermissionsNameByGroupName($group->id);
                            $j = 1;
                        @endphp
                            <div class="col-md-6 pr-3 pb-2">
                                <div class="row">
                                    <div class="col-md-4 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="{{$i}}Management" value="{{$group->name}}" onclick="checkPermissionByGroup('role-{{$i}}-management-checkbox', this)">
                                            <label class="form-check-label" for="{{$i}}Management">{{$group->name}}</label> 
                                        </div>
                                    </div>
                                    @php $permission_id = json_decode($staff_id->permission_id);@endphp
                                    <div class="col-md-8 role-{{$i}}-management-checkbox bg_color">
                                        @foreach ($permissions as $permission)
                                        <div class="form-check ">
                                            <input class="form-check-input" 
                                            type="checkbox" id="rolePermission{{$permission->id}}" 
                                            value="{{$permission->id}}" name="permission_id[]"
                                            onclick="checkSignPermission('role-{{$i}}-management-checkbox', '{{$i}}Management', {{count($permissions)}})"
                                            @if($permission_id && in_array($permission->id,$permission_id)) checked @endif
                                            >
                                            <label class="form-check-label" for="rolePermission{{$permission->id}}">{{$permission->name}}</label> 
                                        </div>
                                        @php $j++ @endphp
                                        @endforeach
                                    </div>            
                                </div>            
                            </div>
                        @php $i++ @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Data Save</button>
        </div>    
    </form>
</div>
@endsection
 
@section('js')
@include('partials.script')
@endsection