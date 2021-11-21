@extends('backend.layouts.app')
@section('content')
<div class="aiz-titlebar text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">New Permission Add</h1>
        </div>
        <div class="col text-right">
            <a href="{{route('permission.index')}}" class="btn btn-circle btn-info">
                <span>Return Back</span>
            </a>
        </div>
    </div>
</div>
@include('errors.error_massege')
<div class="card">
    <form action="{{route('permission.store')}}" method="POST">
        @csrf
        <div class="row card-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="groupName">Group Name</label>
                    <input type="text" class="form-control" id="groupName" placeholder="Group Name like Category" name='name' >
                </div>
                <div class="form-group">
                    <label for="permissionCreate">Permission Creaete</label>
                    <input type="text" class="form-control" id="permissionCreate" placeholder="like category.creaete" name='permissionName[]' >
                </div>
                <div class="form-group">
                    <label for="permissionEdit">Permission Edit</label>
                    <input type="text" class="form-control" id="permissionEdit" placeholder="like category.edit" name='permissionName[]' >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="permissionView">Permission View</label>
                    <input type="text" class="form-control" id="permissionView" placeholder="like category.view" name='permissionName[]' >
                </div>
                <div class="form-group">
                    <label for="permissionDelete">Permission Delete</label>
                    <input type="text" class="form-control" id="permissionDelete" placeholder="like category.delete" name='permissionName[]' >
                </div>
                <div class="form-group">
                    <label for="permissionApprove">Permission Approve</label>
                    <input type="text" class="form-control" id="permissionApprove" placeholder="like category.approve " name='permissionName[]' >
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
@endsection