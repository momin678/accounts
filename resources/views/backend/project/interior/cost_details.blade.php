@extends('backend.layouts.app')
@section('content')
<div style="padding: 10px; border: 1px solid rgb(192, 164, 164); font-size: 18px; line-height: 24px;">
  <div style="width: 100%; line-height: inherit; text-align: left;">
    <div class="text-center h2">
      Work Order
    </div>
    <div style="background: #54b1b117;" class="p-2">
      <span >Date: {{$cost_info->date}}</span>
      <span class="float-right">Order No: {{$cost_info->invoice_number}}</span>
    </div>
    <div class='row p-2'>
      <div class="col-md-6 col-12">
        <label for="">From:</label><br>
        <b>Nazaha Intorior and Architecture</b>,<br />
        Phone: 01744-333320,<br />
        Address: Saleh Sadan, Fourth Floor,  <br />
        145 Motijheel C/A,<br />
        Dhaka - 1000,
      </div>
      <div class="float-right col-12 col-md-6 justify-content" style="float: right;">
        <label for="">To:</label><br>
        <b>{{$supplier_info->name}}</b>,<br />
        Phone: {{$supplier_info->phone}}, <br/>
        @if ($supplier_info->shop)
          Shop Name: {{ $supplier_info->shop }}
        @endif, <br/>
        Address: {{$supplier_info->location}}<br />
        
      </div>
    </div>
  </div>
  <table  class="table-bordered" style="width: 100%; line-height: inherit; text-align: left;">
    <tr style="background: #816666;">
      <td style="padding-left: 10px;">NS</td>
      <td style="padding-left: 10px;">Item Name</td>
      <td style="padding-left: 10px;">Quantity</td>
      <td style="padding-left: 10px;">Price</td>
    </tr>
    @foreach (json_decode($cost_info->name) as $key => $value)
      @php 
        $product_info = App\Models\SupplyGoods::find($value); 
        $quantity = json_decode($cost_info->quantity);
        $amount = json_decode($cost_info->amount);
      @endphp
      <tr>
        <td style="padding-left: 20px;">{{$key+1}}</td>
        <td style="padding-left: 20px;">{{$product_info->name}}</td>
        <td style="padding-left: 20px;">{{$quantity[$key]}}</td>
        <td style="padding-left: 20px;">Tk. {{$amount[$key]}}</td>
      </tr>
    @endforeach
  </table>
</div>
<a href="{{ url()->previous() }}" class="btn btn-warning mt-3">Return Back</a>
@endsection
