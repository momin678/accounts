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
            <h1 class="h3">All Payments</h1>
        </div>
        <div class="col text-right">
            <a href="{{route('project.index')}}" class="btn btn-circle btn-info">
                <span>All Project</span>
            </a>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0 h6">Payment List</h5>
			</div>
			<div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
						    <th>Name</th>
							<th>Amount</th>
							<th>Method</th>
							<th>Date</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						@foreach($all_payment as $key => $payment)
							<tr>
								<td>{{$payment->project_id}}</td>
								<td>{{$payment->amount}}</td>
								<td>{{$payment->method}}</td>
								<td>{{$payment->payment_date}}</td>
								<td>{{$payment->description}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0 h6">Add New Payment</h5>
			</div>
			<div class="card-body">
                <form action="{{ route('get-paymet.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_id" value="{{$projectID}}">
                    <div class="form-group">
                        <label for="name">Payment Date</label>
                        <input type="date" name="payment_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Payment Amount <small>number only</small></label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Payment Method</label>
                        <select class="form-control" name="method" required>
                            <option value="Cahs-on">Cahs-on</option>
                            <option value="Check">Check</option>
                            <option value="bKash">bKash</option>
                            <option value="Nagad">Nagad</option>
                            <option value="Roket">Roket</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Payment Document</label>
                        <input type="file" name="document[]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                    </div>
                    <div class="form-group mb-3 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
			</div>
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