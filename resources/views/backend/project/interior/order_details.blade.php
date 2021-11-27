@extends('backend.layouts.app')
@section('content')
<div style="padding: 10px; border: 1px solid rgb(192, 164, 164); font-size: 18px; line-height: 24px;">
  <table style="width: 100%; line-height: inherit; text-align: left;">
    <tr>
      <td style="padding: 5px;">
        <span style="font-size: 30px;">Datagate</span>
      </td>
    </tr>
    <tr style="background: #54b1b117;">
      <td style="padding: 5px;">Date: {{$order_info->date}}</td>
      <td style="padding: 5px; text-align: right;" colspan="2">Order No: {{$order_info->invoice_number}}</td>
    </tr>
    <tr style="max-width: 500px;">
      <td>
        <address style="padding-left: 10px;">
          <strong>Ordered To:</strong><br />
            Name: Mr. Fakhrujddin<br />
            Phone: 01744-333320,<br />
            Address: Saleh Sadan, Fourth Floor,  <br />
            145 Motijheel C/A,<br />
            Dhaka - 1000,
        </address>
      </td>
      <td style="text-align: right;" colspan="2">
        <address style="padding-right: 10px;">
        <strong>Pay To:</strong><br />
        Name: {{$supply_info->name}},<br />
        Phone: {{$supply_info->phone}}, <br/>
        Address: {{$supply_info->location}}<br />
        </address>
      </td>
    </tr>
    <tr style="background: #816666;">
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
