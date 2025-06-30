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
        .order_deg{
            padding-right: 150px;
            margin-bottom: 290px;
        }
        .cart_table{
            width: 55%;
        }
        input[type="text"], textarea {
            flex:1;
            display: inline-block;
            width: 50%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;       /* Make text smaller */
            font-weight: normal; 
        }
        label {
            display: inline-block;
            width: 150px;
            font-size: 18px;
            font-weight: bold;
        }
        .div-gap {
            display: flex;
            align-items: center;
            padding: 5px;
            gap: 1rem;
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
        <div class="order_deg">
            <form action="{{ url('confirm_order') }}" method="POST">
                @csrf
               
                <div class="div-gap">
                    <label>Receiver Name:</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" required>
                </div>
                <div class="div-gap">
                    <label>Receiver Address:</label>
                    {{-- <textarea> does not use the value attribute. Instead, the value/content of a <textarea> should be placed between the opening and closing tags. --}}
                    <textarea name="address"  required>{{ Auth::user()->address }}</textarea>
                </div>
                <div class="div-gap">
                    <label>Receiver Phone Number:</label>
                    <input type="text" name="phone" value="{{ Auth::user()->phone }}" required>
                </div>
                <div></div>
                <div class="div-gap">
                    <input type="submit" value="Cash On Delivery" class="btn btn-primary me-5" style="cursor: pointer;">
                    
                    <a class="btn btn-success" href="{{ url('stripe') }}">Pay using Card</a>
                </div>
            </form>
        </div>
         
    <div class="cart_table">
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
    </div>
    <div class="cart_value">
        <h3>Total Value of the Cart is: ${{ $value}}</h3>
    </div>

 
@include('home.footer')

  <!-- info section -->



</body>

</html>