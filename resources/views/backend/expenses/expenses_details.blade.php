@extends('backend.layouts.app')
@section('content')
<div class="text-left mb-3 m-4">
    <div class="row align-items-center">
        <div class="col-auto">
          <h1 class="h3">Details Office Expenses</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header text-info">Expenses List of {{ $request->month }} @if($request->date) in {{ $request->date }} @endif
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Added By</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $key => $item)                            
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->amount }} TK.</td>
                                <td>{{ $item->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div><div class="btn-group btn-group-sm d-print-none p-2"> 
    <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none m-2"><i class="fa fa-print"></i> Print</a> 
    
  </div>
@endsection