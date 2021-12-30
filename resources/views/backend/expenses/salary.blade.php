@extends('backend.layouts.app')
@section('css')
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css' ) }}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css' ) }}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css' ) }}">
@endsection
@section('content')
<div class="text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
          <h1 class="h3">Salary List</h1>
        </div>
        {{-- <div class="col text-right">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Add Supplier
          </button>
        </div> --}}
    </div>
</div>

@include('errors.error_massege')
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
							<th>Month</th>
							<th>Pay Amount</th>
							<th>Month</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
            @foreach($salary as $key => $salary)
            @php
              $salaryAmount = App\Models\Salary::salaryAmount($salary->employee_id);
            @endphp
            <tr>
              <td>{{$salary->employee->name}}</td>
              <td>{{$salary->month}}</td>
              <td>{{$salary->amount}}</td>
              <td>{{$salary->method}}</td>
              <td></td>
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
				<h5 class="mb-0 h6">Pay Salary</h5>
			</div>
			<div class="card-body">
        <form action="{{ route('employee-salary.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <select class="form-control" name="employee_id" required>
                    <option value=""></option>
                    @foreach($employees as $employee)
                      <option value="{{$employee->id}}">{{$employee->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Month</label>
                <select name="month" class="form-control">
                  @php
                      use Carbon\CarbonPeriod;
                  @endphp
                  @foreach(CarbonPeriod::create(now()->startOfMonth(), '1 month', now()->addMonths(11)->startOfMonth()) as $date)
                      <option value="{{ $date->format('F') }}">
                        {{ $date->format('F') }}
                      </option>
                  @endforeach
              </select>
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
              <label for="date">Date</label>
              <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date" class="form-control"/>
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
  $("#yes").click(function(){
    var html = '';    
    html +='<div class="form-group">'
    html +=  '<input type="text" name="shop" class="form-control" placeholder="Shop Name......." required>'
    html +='</div>'
    $("#result").html(html);
  });
  $("#no").click(function(){
    var html = '';    
    html +='<div class="form-group">'
    html +=  '<input type="number" name="total_amount" class="form-control" placeholder="Contact value......." required>'
    html +='</div>'
    $("#result").html(html);
  });
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
  const monthControl = document.querySelector('input[type="month"]');
  const date= new Date()
  const month=("0" + (date.getMonth() + 1)).slice(-2)
  const year=date.getFullYear()
  monthControl.value = `${year}-${month}`;
</script>

@endsection