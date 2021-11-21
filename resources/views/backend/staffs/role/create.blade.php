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
            <h1 class="h3">New Role Add</h1>
        </div>
        <div class="col text-right">
            <a href="{{route('role.index')}}" class="btn btn-circle btn-info">
                <span>Return Back</span>
            </a>
        </div>
    </div>
</div>
@include('errors.error_massege')
<div class="card">
    <form action="{{route('role.store')}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="inputAddress">Role Name</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Role Name" name='name' >
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkPermissionAll" value="1">
                <label class="form-check-label" for="checkPermissionAll">All Permission</label> 
            </div>
            <hr>
            <div class="row">
                @php $i = 1; @endphp
                @foreach ($all_permission_group as $group)
                @php
                    $permissions = App\Models\Permission::getpermissionsNameByGroupName($group->id);
                    $j = 1;
                @endphp
                    <div class="col-md-4 pr-3 pb-2">
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="{{$i}}Management" value="{{$group->name}}" onclick="checkPermissionByGroup('role-{{$i}}-management-checkbox', this)">
                                    <label class="form-check-label" for="{{$i}}Management">{{$group->name}}</label> 
                                </div>
                            </div>
                            <div class="col-md-8 role-{{$i}}-management-checkbox bg_color">
                                @foreach ($permissions as $permission)
                                <div class="form-check ">
                                    <input class="form-check-input" 
                                    type="checkbox" id="rolePermission{{$permission->id}}" 
                                    value="{{$permission->name}}" name="permission[]"
                                    onclick="checkSignPermission('role-{{$i}}-management-checkbox', '{{$i}}Management', {{count($permissions)}})"
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
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Data Save</button>
        </div>    
    </form>
</div>
@endsection
 
@section('js')
@include('partials.script')
@endsection