@extends('backend.layouts.app')
@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css' ) }}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css' ) }}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css' ) }}">
@endsection
@section('content')
<div class="text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">All Project</h1>
        </div>
        <div class="col text-right">
            <a href="{{route('project.create')}}" class="btn btn-circle btn-info">
                <span>New Project</span>
            </a>
        </div>
    </div>
</div>
@include('errors.error_massege')
<div class="card">
    <div class="card-header row gutters-5">
        <div class="col text-center text-md-left">
            <h5>All Project</h5>
        </div>
        <div class="text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Adjust Values
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped" >
            <thead>
                <tr>
                    <th width="20%" scope="col">Name</th>
                    <th scope="col">Budget</th>
                    <th scope="col">Adjust</th>
                    <th scope="col">Peyment</th>
                    <th scope="col">Due</th>
                    <th scope="col">Spending/Cost</th>
                    <th scope="col">Profite</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                <tr>
                    @php
                        $total_payment = App\Models\Project::totalPayment($project->id);
                        $total_cost = App\Models\Project::totalCost($project->id);
                        $adjust_values = App\Models\Project::adjust_values($project->id);
                    @endphp
                    <td><a href="{{ route('project.show', $project->id) }}">{{$project->name}}</a></td>
                    <td>TK. {{$project->budget+$adjust_values}}</td>
                    <td>TK. {{$adjust_values}}</td>
                    <td>TK. {{$total_payment}}</td>
                    <td>TK. {{$project->budget - $total_payment}}</td>
                    <td>TK. {{$total_cost}}</td>
                    <td>TK. {{($project->budget+$adjust_values) - $total_cost}}</td>
                    <td>{{ $project->status }}</td>
                </tr>
                @endforeach                
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Adjust Value</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('adjust-value.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Project name</label>
                    <select name="project_id" class="form-control" required>
                        <option value="">Select name</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="number" class="form-control" name="amount" required>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="" cols="5" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
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
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
