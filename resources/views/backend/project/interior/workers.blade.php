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
            <h1 class="h3">All Workers</h1>
        </div>
        <div class="col text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
              Add Worker
            </button>
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
							<th>Phone</th>
							<th>Contact Values</th>
							<th>Payment</th>
							<th>Due</th>
						</tr>
					</thead>
					<tbody>
					    @foreach($all_worker as $key => $worker)
					    <tr>
					        <td><a href="{{ route('workers-list.show', $worker->id) }}">{{$worker->name}}</a></td>
					        <td>{{$worker->phone}}</td>
					        <td>{{$worker->values}}</td>
					        <td>{{$worker->payments}}</td>
					        <td>{{$worker->values-$worker->payments}}</td>
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
                <form action="{{ route('project.expenses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" class="form-control" value="worker">
                    <div class="form-group">
                        <label for="name">Payment Project</label>
                        <select class="form-control multiple_select" name="project_id" required>
                            <option value=""></option>
                            @foreach($all_project as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Worker name</label>
                        <select class="form-control multiple_select" name="worker_supplier" required>
                            <option value=""></option>
                            @foreach($all_worker as $key => $worker)
                                <option value="{{$worker->id}}">{{$worker->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Payment Date</label>
                        <input type="date" name="date" class="form-control" required>
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
                    <div class="form-group mb-3 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New Worker Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('workers-list.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="recipient-name" placeholder="Worker Name......." required>
              </div>
              <div class="form-group">
                <input type="text" name="phone" class="form-control" id="recipient-name" placeholder="Phone Number......." required>
              </div>
              <div class="form-group">
                <input type="text" name="location" class="form-control" id="recipient-name" placeholder="Location.......">
              </div>
              <div class="form-group">
                <input type="number" name="values" class="form-control" id="recipient-name" placeholder="Contact Values......." required>
              </div>
              <div class="form-group">
                <textarea rows="2" name="description" class="form-control" placeholder="Descrition......."></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
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
  });
</script>

@endsection