<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        .div_deg{
            display:flex;
            justify-content:center;
            align-items:center;
            margin:60px;
        }
        table{
            border:2px solid black;
            text-align: center;
            width: 100%;
        }
        th{
            border:2px solid black;
            text-align: center;
            color: rgb(13, 12, 12);
            background-color: rgb(156, 163, 167);
            font-size: 20px;
            font:20px;
        }
        td{
            border:2px solid black;
            text-align: center;
        }
        .cart_value{
            text-align: center;
            margin: 20px;
            font-size: 20px;
            padding: 20px;
        }
    </style>
</head>

<body>
  @if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<script>
    // Auto-close after 5 seconds
    setTimeout(function () {
        const alert = document.getElementById('success-alert');
        if (alert) {
            // Bootstrap 4 uses jQuery’s .alert('close') method
            $(alert).alert('close');
        }
    }, 5000);
</script>
@endif
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>

    <div class="div_deg">
        <table>
            <tr>
                <th>Product Title</th>
                <th>Product Price</th>
                <th>Product Image</th>
                <th>Remove</th>
            </tr>
            <?php
             $value=0;

            ?>
            @foreach($cart as $cart)
            <tr>
                <td>{{$cart->product->title}}</td>
                <td>{{$cart->product->price}}</td>
                <td><img width="150" src="/products/{{$cart->product->image}}"></td>
                <td>

                    <a class="btn btn-danger" href="{{url('remove_cart',$cart->id)}}">Remove</a>
                </td>
            </tr>
            <?php
            $value=$value+$cart->product->price
            ?>
            @endforeach
        </table>
    </div>
    <div class="cart_value">
        <h3>Total Value of the Cart is: ${{ $value}}</h3>
    </div>

 
@include('home.footer')

  <!-- info section -->



</body>

</html>