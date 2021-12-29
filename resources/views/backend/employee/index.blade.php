@extends('backend.layouts.app')
@section('content')
<div class="text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
          <h1 class="h3">All Supplier</h1>
        </div>
        <div class="col text-right">
            <a href="{{route('employees.create')}}" class="btn btn-circle btn-info">
                <span>New Employee</span>
            </a>
        </div>
    </div>
</div>
@include('errors.error_massege')
<div class="row">
    <div class="card col-md-12">
        <div class="card-header">
            Employees List
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Desigantion</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Option</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($all_employees as $key => $employee)
                    <tr>
                        {{-- <td>{{ $key+1 ($all_employees -1) * $all_employees->perPage()}}</td> --}}
                        <td>{{ $key+1 }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->designation }}</td>
                        <td>{{ $employee->salary }} TK.</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{route('employees.edit', $employee->id)}}" type="button" class="btn btn-info mr-2">Edit</a>
                            <a class="btn btn-danger text-white" href="{{ route('employees.destroy', $employee->id) }}"
                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $employee->id }}').submit();">
                                    Delete
                            </a>
                            <form id="delete-form-{{ $employee->id }}" action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection