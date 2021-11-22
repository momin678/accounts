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
<div class="card">
    <div class="card-header row gutters-5">
        <div class="col text-center text-md-left">
            <h5 class="mb-md-0 h6">Project List</h5>
        </div>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped" >
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th width="20%" scope="col">Name</th>
                    <th scope="col">Values</th>
                    <th scope="col">Peyment</th>
                    <th scope="col">Due</th>
                    <th scope="col">Spending/Cost</th>
                    <th scope="col">Profite</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                <tr>
                    @php
                        $total_payment = App\Models\Project::totalPayment($project->id);
                        $total_cost = App\Models\Project::totalCost($project->id);
                    @endphp
                    <td>{{$loop->index+1}}</td>
                    <td>{{$project->name}}</td>
                    <td>TK. {{$project->budget}}</td>
                    <td><a href="{{route('project.get-paymet', $project->id)}}">TK. {{$total_payment}}</a></td>
                    <td>TK. {{$project->budget - $total_payment}}</td>
                    <td><a href="{{route('project.spending', $project->id)}}">TK. {{$total_cost}}</a></td>
                    <td>TK. {{$project->budget - $total_cost}}</td>
                </tr>   
                @endforeach                
            </tbody>
        </table>
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
