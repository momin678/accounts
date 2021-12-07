<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script></script>
    <title>Work Order</title>
  </head>
  <body>
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
          <div class="float-right col-12 col-md-6 justify-content">
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>