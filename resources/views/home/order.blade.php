<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>myorders</title>
    @include('home.css')
    <style>
      .center{
        display: flex;
        justify-content: center;
        align-items: center;
        margin:100px;
      }
      table{
        border: 2px solid black;
        text-align: center;
        width:800px;
      }
      th{
        border: 2px solid black;
        color:white;
        background-color: skyblue;
        font-size:20px;
        font-weight:bold;
        text-align: center;
      }
      td{
        border: 2px solid black;
        text-align: center;
        font-size:15px;
        padding: 8px;
      }
    </style>
</head>
<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <div class="center">
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Delivery Status</th>
                    <th>Product Image</th>
                </tr>
                @foreach ($order as $order )
                <tr>
                    <td>{{$order->product->title}}</td>
                    <td>{{$order->product->price}}</td>
                    <td>{{$order->status}}</td>
                    <td><img 
                        height="100"
                        width="100"
                        src="products/{{$order->product->image}}"></td>
                </tr> 
                @endforeach
                
            </table>
        </div>
    </div>
        @include('home.footer')
</body>
</html>