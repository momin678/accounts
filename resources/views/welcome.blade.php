<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body class="antialiased">
        <div style="padding: 10px; border: 1px solid rgb(192, 164, 164); font-size: 18px; line-height: 24px;">
            <div style="width: 100%; line-height: inherit; text-align: left;">
              <div class="text-center h2">
                Work Order
              </div>
              <div style="background: #54b1b117;" class="p-2">
                <span >Date: 12/12/2021</span>
                <span class="float-right">Order No: 8523547896</span>
              </div>
              <div class='row'>
                <span style="max-width: 500px; min-width: 500px;">
                    From:<br>
                  <b>Nazaha Intorior and Architecture</b>,<br />
                  Phone: 01744-333320,<br />
                  Address: Saleh Sadan, Fourth Floor,  <br />
                  145 Motijheel C/A,<br />
                  Dhaka - 1000,
                </span>
                <span class="float-right">
                    To:<br>
                  <b>Md. Mominul</b>,<br/>
                  Phone: 01773786001, <br/>
                    Shop Name: Nazaha Traders,<br />
                  Address: Motijheel, Dhaka
                </span>
              </div>
            </div>
            <table class="table-bordered" style="width: 100%; line-height: inherit; text-align: left;">
                <tr style="background: #816666;">
                    <td style="padding-left: 10px;">NS</td>
                    <td style="padding-left: 10px;">Item Name</td>
                    <td style="padding-left: 10px;">Description</td>
                    <td style="padding-left: 10px;">Quantity</td>
                </tr>
                <tr>
                    <td style="padding-left: 20px;">1</td>
                    <td style="padding-left: 20px;">monitor</td>
                    <td style="padding-left: 20px;">monitor description</td>
                    <td style="padding-left: 20px;">50</td>
                </tr>
                <tr>
                  <td style="padding-left: 20px;">2</td>
                  <td style="padding-left: 20px;">keyboard</td>
                  <td style="padding-left: 20px;">keyboard description</td>
                  <td style="padding-left: 20px;">20</td>
                </tr>
            </table>
          </div>
    </body>
</html>
