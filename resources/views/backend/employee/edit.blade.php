@extends('backend.layouts.app')
@section('content')
<div class="text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
          <h1 class="h3">Edit Supplier</h1>
        </div>
        <div class="col text-right">
            <a href="{{route('employees.index')}}" class="btn btn-circle btn-info">
                <span>All Employee</span>
            </a>
        </div>
    </div>
</div>
<div class="card col-7 col-md-8">
    <div class="card-body">
        <form method="post" action="{{route('employees.update', $employee->id)}}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" id="inputName" name="name" class="form-control" required value="{{ $employee->name }}"/>
            </div>
            <div class="form-group">
                <label for="inputEmail">E-Mail</label>
                <input type="email" id="inputEmail" name="email" class="form-control" required value="{{ $employee->email }}"/>
            </div>
            <div class="form-group">
                <label for="inputDesignation">Designation</label>
                <input type="text" id="inputDesignation" name="designation" class="form-control" required value="{{ $employee->designation }}"/>
            </div>
            <div class="form-group">
                <label for="inputQualification">Qualification</label>
                <input type="text" id="inputQualification" name="qualification" class="form-control" required value="{{ $employee->qualification }}"/>
            </div>
            <div class="form-group">
                <label for="phonename">Phone Number</label>
                <input type="text" id="phonename" name="number" class="form-control" required value="{{ $employee->number }}"/>
            </div>
            <div class="form-group">
                <label for="Salary">Saraly</label>
                <input type="number" id="Salary" name="salary" class="form-control" value="{{ $employee->salary }}"/>
            </div>
            <div class="form-group">
                <label for="inputDocuments">Documents</label>
                <input type="file" id="inputDocuments" name="documents[]" class="form-control" multiple />
                @foreach (json_decode($employee->documents) as $document)
                    <img src="{{ asset('assets/document') }}/{{ $document }}" alt="" height="50" class="m-2">
                @endforeach
            </div>
            <div class="form-group">
                <label for="inputAddress">Present Address</label>
                <textarea id="inputAddress" class="form-control" name="address" rows="2" required>{{ $employee->address }}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
  </div>
@endsection