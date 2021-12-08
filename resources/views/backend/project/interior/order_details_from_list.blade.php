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
      <div class="float-right col-12 col-md-6 justify-content" style="float: right;">
        <label for="">To:</label><br>
        <b>{{$supply_info->name}}</b>,<br/>
        Phone: {{$supply_info->phone}}, <br/>
        @if ($supply_info->shop)
          Shop Name: {{ $supply_info->shop }}
        @endif, <br/>
        Address: {{$supply_info->location}}<br />
      </div>
    </div>
      <div style="padding: 10px;" class="badge badge-danger h6">Order Status: {{ $order_info->status==0 ? 'Pannding' : 'Complated' }}  </div>
  </div>
  <table  class="table-bordered" style="width: 100%; line-height: inherit; text-align: left;">
    <tr style="background: #816666;">
      <td style="padding-left: 5px;">NS</td>
      <td style="padding-left: 10px;">Item Name</td>
      <td style="padding-left: 10px;">Description</td>
      <td style="padding-left: 10px;">Quantity</td>
      <td style="padding-left: 10px;">Price</td>
    </tr>
    @php
        $total_amount = 0;
    @endphp
    @foreach (json_decode($order_info->name) as $key => $value)
      @php 
        $product_info = App\Models\SupplyGoods::find($value); 
        $quantity = json_decode($order_info->quantity);
        if($cost_info){
          $costs = json_decode($cost_info->amount);          
          $total_amount += $costs[$key];
        }else {
          $costs = [];
        }
        
      @endphp
      <tr>
        <td style="padding-left: 20px;">{{$key+1;}}</td>
        <td style="padding-left: 20px;">{{$product_info->name}}</td>
        <td style="padding-left: 20px;">{{$product_info->description}}</td>
        <td style="padding-left: 20px;">{{$quantity[$key]}}</td>
        <td style="padding-left: 20px;">
          @if ($costs)
            {{$costs[$key]}}
          @endif
        </td>
      </tr>
    @endforeach
    <tr >
      <td colspan="4" style="padding: 20px"><b>Total Amount:</b> </td>
      <td style="padding: 20px"><b>Tk. {{ $total_amount }}</b> </td>
    </tr>
  </table>
</div>
<a href="{{ url()->previous() }}" class="btn btn-warning mt-3">Return Back</a>
@endsection
