@php
    use App\Models\User;
    $totalPermissnion = User::checkPermission();
@endphp
@extends('backend.layouts.app')
@section('css')
<style>
.editForm{
    display: none;
}
.nopadding {
    padding-left: 4px !important;
    padding-right: 4px !important;
}
</style>
@endsection
@section('content')
    <div class="aiz-titlebar text-left mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">All Permission</h1>
            </div>
            @if(Auth::user()->user_type == 'admin' || in_array('29', $totalPermissnion))
            <div class="col text-right">
                <a href="{{route('permission.create')}}" class="btn btn-circle btn-info">
                    <span>Add New Permission</span>
                </a>
            </div>
            @endif
        </div>
    </div>
    
    @include('errors.error_massege')
    <div class="row">
        @foreach ($permissions_groups as $group)
        @php
            $permissions = App\Models\Permission::where('group_id',$group->id)->get();
        @endphp
        <div class="col-md-4 p-3 ">
            <div class="row card">
                <div class="card-header nopadding">
                    <div class="form-check mb-3">
                        <label class="form-check-label text-capitalize" for=""><span class="badge badge-info mr-1">{{$group->id}} </span> {{$group->name}}</label>
                        @if(Auth::user()->user_type == 'admin' || in_array(32, $totalPermissnion))
                        <a href="{{route('permission-group-delete',$group->id)}}" class="btn btn-danger btn-sm  float-right"> Delete </a>
                        @endif
                        <!--<a href="{{route('permission-group-edit',$group->id)}}" class="btn btn-info btn-sm float-right mr-2"> Edit</a>-->
                    </div>
                    @if(Auth::user()->user_type == 'admin' || in_array('29', $totalPermissnion))
                      <form method="post" action="{{route('permission.add', $group->id)}}">
                          @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control m-input" placeholder="Add permission like category.edit" autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
                <div class="card-body nopadding">
                    @foreach ($permissions as $permission)
                    <div class="form-check mb-1">
                        <label class="form-check-label m-1"><span class="badge badge-info mr-1">{{$permission->id}} </span> {{$permission->name}}</label>
                        @if(Auth::user()->user_type == 'admin' || in_array(32, $totalPermissnion))
                        <a class="btn btn-danger btn-sm  float-right" href="{{ route('permission.destroy', $permission->id) }}"
                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $permission->id }}').submit();">
                                Delete
                        </a>
                        <form id="delete-form-{{ $permission->id }}" action="{{ route('permission.destroy', $permission->id) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                        @endif
                        @if(Auth::user()->user_type == 'admin' || in_array(30, $totalPermissnion))
                        <button type="submit" class="btn btn-primary  btn-sm  float-right edit_id mr-1" id="{{$permission->id}}">Edit</button>
                        <form id="form{{ $permission->id }}" action="{{ route('permission.update', $permission->id) }}" method="POST" class="editForm">
                            @method("PUT")
                            @csrf
                            <div class="input-group mb-1 mt-1">
                                <input type="text" name="permissionName" class="form-control m-input" value="{{$permission->name}}" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                    
                    @endforeach
                </div>
            </div>            
        </div>
        @endforeach
    </div>
@endsection
@section('js')
    <script>
        $("button").click(function(){
            let id = $(this).attr('id');
            $("#form"+id).show();
        });
    </script>
@endsection
