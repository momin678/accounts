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
            <h1 class="h3">All order</h1>
        </div>
        <div class="col text-right">
            <a href="{{route('make-order.create')}}" class="btn btn-circle btn-info">
                <span>New order</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header row gutters-5">
        <div class="col text-center text-md-left">
            <h5 class="mb-md-0 h6">Development order List</h5>
        </div>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped" >
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th width="20%" scope="col">Project Name</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Order Number</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_order as $order)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>
                        @foreach ($all_project as $project)
                            @if ($order->project_id == $project->id)
                                {{ $project->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($all_supplier as $supplier)
                            @if ($order->supplier_id == $supplier->id)
                                {{ $supplier->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$order->date}}</td>
                    <td>{{$order->invoice_number}}</td>
                    <td>
                        @if ($order->status == 0)
                           <a href="{{ route('order-check', $order->id) }}">Pandding</a> 
                        @else
                           Complate/ <a href="{{ route('return-check', $order->id) }}">Return</a>
                        @endif
                    </td>
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
