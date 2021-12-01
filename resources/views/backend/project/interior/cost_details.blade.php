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
      <td style="padding: 5px;">Date: {{$cost_info->date}}</td>
      <td style="padding: 5px; text-align: right;" colspan="2">Order No: {{$cost_info->invoice_number}}</td>
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
        Name: {{$supplier_info->name}},<br />
        Phone: {{$supplier_info->phone}}, <br/>
        @if ($supplier_info->shop)
          Shop Name: {{ $supplier_info->shop }}
        @endif, <br/>
        Address: {{$supplier_info->location}}<br />
        </address>
      </td>
    </tr>
    <tr style="background: #816666;">
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
        <td style="padding-left: 20px;">{{$product_info->name}}</td>
        <td style="padding-left: 20px;">{{$quantity[$key]}}</td>
        <td style="padding-left: 20px;">Tk. {{$amount[$key]}}</td>
      </tr>
    @endforeach
  </table>
</div>
<button class="btn btn-warning mt-3"> <a href="{{ url()->previous() }}">Return Back</a></button>
@endsection
