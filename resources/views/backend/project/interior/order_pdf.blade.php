<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Order</title>
</head>
<body>
  <div style="padding: 10px; border: 1px solid #eee; font-size: 18px; line-height: 24px;">
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
        <td style="min-width:200px; max-width:200px; padding-left: 10px;">Item Name</td>
        <td style="min-width:200px; max-width:200px; padding-left: 10px;">Description</td>
        <td style="min-width:50px; max-width:50px; padding-left: 10px;">Quantity</td>
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
</body>
</html>