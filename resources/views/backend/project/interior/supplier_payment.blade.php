@extends('backend.layouts.app')
@section('css')
@endsection
@section('content')
<div class="text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">All Suppier Payment</h1>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-4">
        <div class="card">
			<div class="card-header">
				<h5 class="mb-0 h6">Supplier Payment</h5>
			</div>
			<div class="card-body">
                <form action="{{ route('project.expenses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" class="form-control" value="supplier">
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
                        <label for="name">Supplier name</label>
                        <select class="form-control multiple_select" name="worker_supplier" required>
                            <option value=""></option>
                            @foreach($all_supplier as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
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
@endsection

@section('js')

@endsection