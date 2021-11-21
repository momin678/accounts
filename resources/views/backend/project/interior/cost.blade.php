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
            <h1 class="h3">All Cost</h1>
        </div>
        <div class="col text-right">
            <a href="{{route('project.index')}}" class="btn btn-circle btn-info">
                <span>All Project</span>
            </a>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0 h6">Cost List</h5>
			</div>
			<div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
						    <th>Name</th>
						    <th>Quantity</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
					    @foreach($all_cost as $cost)
					        @php $total = 0; @endphp
    					    @foreach(json_decode($cost->name) as $key => $name)
    			                <tr>
        					        <td>{{$name}}</td>
        					        <td>@php $quantity = json_decode($cost->quantity); echo $quantity[$key] @endphp</td>
        					        <td>
        					            @php
            					        $amount = json_decode($cost->amount); echo $amount[$key]." .BDT";
            					        $total += $amount[$key];
            					        @endphp
        					        </td>
    			                </tr>
    					    @endforeach
    					    <tr>
    					        <td colspan="1">Date: {{$cost->date}}</td>
    					        <td colspan="2">Total Cost = {{$total}} .TK </td>
    					    </tr>
					    @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0 h6">Add New Cost</h5>
			</div>
			<div class="card-body">
                <form action="{{ route('project.cost.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_id" value="{{$projectID}}">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input type="text" name="name[]" class="form-control" placeholder="Product name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <input type="text" name="quantity[]" class="form-control" required placeholder="product quantity">
                        </div>
                        <div class="form-group col-md-5">
                            <input type="number" name="amount[]" class="form-control" required placeholder="total price">
                        </div>
                        <div class="form-group col-md-2">
                            <button id="addRow" type="button" class="btn btn-info"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div id="newRow"></div>
                    <div class="form-group">
                        <label for="name">Cost Document</label>
                        <input type="file" name="document[]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Cost Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <textarea class="form-control" rows="3" name="description"></textarea>
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
  });
</script>
<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var addNew = '';
        addNew += '<div class="row" id="inputFormRow">'
        addNew +=   '<div class="form-group col-md-12">'
        addNew +=       '<input type="text" name="name[]" class="form-control" placeholder="Product name" required>'
        addNew +=   '</div>'
        addNew +=    '<div class="form-group col-md-5">'
        addNew +=        '<input type="text" name="quantity[]" class="form-control" required placeholder="product quantity">'
        addNew +=    '</div>'
        addNew +=    '<div class="form-group col-md-5">'
        addNew +=        '<input type="number" name="amount[]" class="form-control" required placeholder="product amount">'
        addNew +=    '</div>'
        addNew +=    '<div class="col-md-2">'
        addNew +=        '<button id="removeRow" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>'
        addNew +=    '</div>'
        addNew += '</div>'
        $('#newRow').append(addNew);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>
@endsection