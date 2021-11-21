@php
    use App\Models\User;
    $totalPermissnion = User::checkPermission();
@endphp
@extends('backend.layouts.app')
@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css' ) }}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css' ) }}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css' ) }}">
@endsection
@section('content')
          
        <div class="aiz-titlebar text-left mb-3">
            <div class="row align-items-center">
                <div class="col-auto">
                    <h1 class="h3">All Roles</h1>
                </div>
                @if(Auth::user()->user_type == 'admin' || in_array('6', $totalPermissnion))
                <div class="col text-right">
                    <a href="{{route('role.create')}}" class="btn btn-circle btn-info">
                        <span>Add New Role</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
        
        @include('errors.error_massege')
        <div class="row">
          <div class="col-12">

            <div class="card mt-3">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Permission Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                  <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <th>{{$loop->index+1}}</th>
                        <td>{{$role->name}}</td>
                        <td>
                            <select class="form-control">
                                @foreach ($role->permissions as $permission)
                                    <option>{{$permission->name}}</option>
                                @endforeach
                            </select>
                               
                        </td>
                        <td class="d-flex justify-content-center">
                            @if(Auth::user()->user_type == 'admin' || in_array('8', $totalPermissnion))
                            <a href="{{route('role.edit', $role->id)}}" type="button" class="btn btn-info mr-2">Edit</a>
                            @endif
                            @if(Auth::user()->user_type == 'admin' || in_array('9', $totalPermissnion))
                            <a class="btn btn-danger text-white" href="{{ route('role.destroy', $role->id) }}"
                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                    Delete
                            </a>
                            <form id="delete-form-{{ $role->id }}" action="{{ route('role.destroy', $role->id) }}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                            @endif
                        </td>
                    </tr>   
                    @endforeach                
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
@endsection
@section('js')
<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js' ) }}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js' ) }}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js' ) }}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js' ) }}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js' ) }}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js' ) }}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js' ) }}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js' ) }}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js' ) }}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js' ) }}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js' ) }}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js' ) }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection
