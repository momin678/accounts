@extends('backend.layouts.app')
@section('css')
@endsection
@section('content')
<div class="aiz-titlebar text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">New Project</h1>
        </div>
        <div class="col text-right">
            <a href="{{route('project.index')}}" class="btn btn-circle btn-info">
                <span>Return</span>
            </a>
        </div>
    </div>
</div>
@include('errors.error_massege')
<div class="card">
    <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="groupName">Project Name</label>
                        <input type="text" class="form-control" placeholder="Project Name" name='name' required>
                    </div>
                    <div class="form-group">
                        <label for="permissionCreate">Project Start</label>
                        <input type="date" class="form-control"  name='start' >
                    </div>
                    <div class="form-group">
                        <label for="permissionEdit">Project End</label>
                        <input type="date" class="form-control" name='end' >
                    </div>
                    <div class="form-group">
                        <label for="permissionEdit">Project Expiration</label>
                        <input type="date" class="form-control" name='expiration' >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="permissionView">Project Budget <small> (number only)</small></label>
                        <input type="number" class="form-control" name='budget' >
                    </div>
                    <div class="form-group">
                        <label for="permissionDelete">Project Location</label>
                        <input type="text" class="form-control" placeholder="Project Location" name='location' >
                    </div>
                    <div class="form-group">
                        <label for="permissionApprove">Institution Name</label>
                        <input type="text" class="form-control" placeholder="Institution Name " name='institution' >
                    </div>
                    <div class="form-group">
                        <label for="permissionApprove">Project Document</label>
                        <input type="file" class="form-control"  name='document[]' >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Project Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
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