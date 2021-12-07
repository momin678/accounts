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
      <td  colspan="2">
        @php
        $total_supplier_values = 0;
        foreach ($supply_value as $values){
            foreach (json_decode($values->amount) as $amount){
                $total_supplier_values += $amount;
            }
        }
        $total_return_amount = 0;
        foreach ($return_info as $return){
            foreach (json_decode($return->amount) as $amount){
                $total_return_amount += $amount;
            }
        }
        $totale_payment = 0;
        foreach ($make_payment as $payment){
            $totale_payment += $payment->amount;
        }
        $merge = $total_supplier_values - ($total_return_amount+$totale_payment)
        @endphp
        <address style="padding-right: 10px;">
        <strong>Payment Summery:</strong><br />
        Supply Values: Tk. {{ $total_supplier_values }},<br />
        Return Values: Tk. {{ $total_return_amount }}, <br/>
        Payment Amount: Tk. {{ $totale_payment }}.
        <hr>
        Due/Merge: Tk. {{ $merge }}.
        </address>
      </td>
    </tr>
  </table>      
  <div class="row">
    <div class="col-md-6 col-12">
        <p class="text-center text-success">Payment</p>
        <table class="table table-sm table-bordered" cellspacing="0">
            <thead>
                <th>Project Name</th>
                <th>Date</th>
                <th>Method</th>
                <th>Amount</th>
            </thead>
            <tbody>
                @foreach ($make_payment as $payment)
                    <tr>
                        <td>{{ $payment->project->name }}</td>
                        <td>{{ $payment->date }}</td>
                        <td>{{ $payment->method }}</td>
                        <td>TK. {{ $payment->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="text-center text-success">Return </p>
        <table class="table table-sm table-bordered" cellspacing="0">
            <thead>
                <th>Date</th>
                <th>Order Number</th>
                <th>Amount</th>
            </thead>
            <tbody>
                @php
                    $total_return_amount = 0;
                @endphp
                @foreach ($return_info as $return)
                    <tr>
                        <td><a href="{{ route('returned.show', $return->id) }}">{{ $return->date }}</a></td>
                        <td>{{ $return->invoice_number }}</td>
                        @php
                            $return_amount = 0;
                            foreach (json_decode($return->amount) as $amount){
                                $return_amount += $amount;
                            }
                            $total_return_amount += $return_amount;
                        @endphp
                        <td>{{ $return_amount }}</td>
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
<a href="{{ url()->previous() }}" class="btn btn-warning mt-3">Return Back</a>
@endsection
