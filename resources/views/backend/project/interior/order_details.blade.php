@extends('backend.layouts.app')
@section('content')
<div style="padding: 10px; border: 1px solid rgb(192, 164, 164); font-size: 18px; line-height: 24px;">
  <div style="width: 100%; line-height: inherit; text-align: left;">
    <div class="text-center h2">
      Work Order
    </div>
    <div style="background: #54b1b117;" class="p-2">
      <span >Date: {{$order_info->date}}</span>
      <span class="float-right">Order No: {{$order_info->invoice_number}}</span>
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
      <div class="col-12 col-md-6 text-right">
        <label for="">To:</label><br>
        <b>{{$supply_info->name}}</b>,<br/>
        Phone: {{$supply_info->phone}}, <br/>
        @if ($supply_info->shop)
          Shop Name: {{ $supply_info->shop }}
        @endif, <br/>
        Address: {{$supply_info->location}}<br />
      </div>
    </div>
  </div>
  <table class="table-bordered" style="width: 100%; line-height: inherit; text-align: left;">
    <tr style="background: #816666;">
      <td style="padding-left: 10px;">NS</td>
      <td style="padding-left: 10px;">Item Name</td>
      <td style="padding-left: 10px;">Description</td>
      <td style="padding-left: 10px;">Quantity</td>
    </tr>
    @foreach (json_decode($order_info->name) as $key => $value)
      @php 
        $product_info = App\Models\SupplyGoods::find($value); 
        $quantity = json_decode($order_info->quantity);
      @endphp
      <tr>
        <td style="padding-left: 20px;">{{$key+1}}</td>
        <td style="padding-left: 20px;">{{$product_info->name}}</td>
        <td style="padding-left: 20px;">{{$product_info->description}}</td>
        <td style="padding-left: 20px;">{{$quantity[$key]}}</td>
      </tr>
    @endforeach
  </table>
</div>
<div class="btn-group btn-group-sm d-print-none p-2"> 
  <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none m-2"><i class="fa fa-print"></i> Print</a> 
  <a href="{{route('order-pdf', $order_info->id)}}" class="btn btn-light border text-black-50 shadow-none m-2"><i class="fa fa-download"></i> PDF</a>
  <a href="{{route('make-order.edit', $order_info->id)}}" class="btn btn-light border text-black-50 shadow-none m-2"><i class="far fa-edit"></i> Edit</a>
</div>
@endsection
