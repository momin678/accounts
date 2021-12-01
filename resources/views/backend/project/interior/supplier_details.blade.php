@extends('backend.layouts.app')
@section('content')
<div style="padding: 10px; border: 1px solid rgb(192, 164, 164); font-size: 18px; line-height: 24px;">
  <table style="width: 100%; line-height: inherit; text-align: left;">
    <tr style="max-width: 500px;">
      <td>
        <address style="padding-right: 10px;">
        <strong>Supplier Information:</strong><br/>
        Name: {{$supplier_info->name}},<br />
        Phone: {{$supplier_info->phone}}, <br/>
        @if ($supplier_info->shop)
          Shop Name: {{ $supplier_info->shop }}
        @endif, <br/>
        Address: {{$supplier_info->location}}<br />
        </address>
      </td>
    </tr>
  </table>      
  <div class="row">
    <div class="col-md-6 col-12">
        <p class="text-center text-success">Payment</p>
        <table class="table table-sm table-bordered" cellspacing="0">
            <thead>
                <th>Date</th>
                <th>Method</th>
                <th>Amount</th>
            </thead>
            <tbody>
                @foreach ($make_payment as $payment)
                    <tr>
                        <td>{{ $payment->date }}</td>
                        <td>{{ $payment->method }}</td>
                        <td>TK. {{ $payment->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6 col-12">
        <p class="text-center text-success">Supply Values</p>
        <table class="table  table-sm table-bordered" cellspacing="0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Order Number</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supply_value as $values)
                    <tr>
                        <td><a href="{{ route('project.cost.show', $values->id)}}">{{ $values->date }}</a></td>
                        <td>{{ $values->invoice_number }}</td>
                        <td>
                            @php
                                $total_amount = 0;
                                foreach (json_decode($values->amount) as $amount){
                                    $total_amount += $amount;
                                }
                            @endphp
                            TK.{{ $total_amount }}
                        </td>
                    </tr>                                    
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
<button class="btn btn-warning mt-3"> <a href="{{ url()->previous() }}">Return Back</a></button>
@endsection
