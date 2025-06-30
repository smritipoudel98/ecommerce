<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px 0;
        }

        table {
            border-collapse: collapse;
            border: 2px solid black;
            text-align: center;
            width: 100%;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
        }

        th,
        td {
            border: 2px solid black;
            padding: 12px 15px;
            vertical-align: middle;
        }

        th {
            background-color: #9ca3af; /* lighter gray */
            color: #0d0c0c;
            font-size: 20px;
            font-weight: 700;
        }

        td img {
            max-width: 150px;
            height: auto;
            border-radius: 6px;
            object-fit: cover;
        }

        .cart_value {
            text-align: center;
            margin: 20px auto 50px;
            font-size: 22px;
            font-weight: 600;
            max-width: 800px;
        }

        .order_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 600px;
            margin: 0 auto 100px;
            padding: 20px;
            background-color: #f9fafb;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgb(0 0 0 / 0.05);
        }

        form {
            width: 100%;
        }

        .div-gap {
            display: flex;
            align-items: center;
            padding: 8px 0;
            gap: 1rem;
        }

        label {
            display: inline-block;
            width: 160px;
            font-size: 18px;
            font-weight: 600;
            color: #1f2937; /* dark gray */
        }

        input[type="text"],
        textarea {
            flex: 1;
            padding: 10px 12px;
            font-size: 16px;
            border: 1.5px solid #d1d5db;
            border-radius: 6px;
            transition: border-color 0.3s ease;
            font-weight: 400;
            resize: vertical;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #3b82f6; /* blue */
            outline: none;
            box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
        }

        input[type="submit"],
        .btn-success {
            padding: 12px 24px;
            font-size: 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-top: 8px;
        }

        input[type="submit"] {
            background-color: #3b82f6;
            color: white;
            margin-right: 15px;
        }

        input[type="submit"]:hover {
            background-color: #2563eb;
        }

        .btn-success {
            background-color: #22c55e;
            color: white;
        }

        .btn-success:hover {
            background-color: #16a34a;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .order_deg {
                max-width: 90%;
                padding: 15px;
            }

            .div-gap {
                flex-direction: column;
                align-items: flex-start;
            }

            label {
                width: 100%;
                margin-bottom: 6px;
            }

            input[type="submit"],
            .btn-success {
                width: 100%;
                margin: 8px 0 0 0;
            }
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
                $(alert).alert('close');
            }
        }, 5000);
    </script>
    @endif

    <div class="hero_area">
        <!-- header section starts -->
        @include('home.header')
        <!-- end header section -->
    </div>

    <div class="div_deg">
        <div class="cart_table">
            <table>
                <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Product Price</th>
                        <th>Product Image</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $value = 0; ?>
                    @foreach($cart as $cart)
                    <tr>
                        <td>{{ $cart->product->title }}</td>
                        <td>${{ number_format($cart->product->price, 2) }}</td>
                        <td><img src="/products/{{ $cart->product->image }}" alt="{{ $cart->product->title }}"></td>
                        <td>
                            <a class="btn btn-danger" href="{{ url('remove_cart', $cart->id) }}">Remove</a>
                        </td>
                    </tr>
                    <?php $value += $cart->product->price; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="cart_value">
        <h3>Total Value of the Cart is: ${{ number_format($value, 2) }}</h3>
    </div>

    <div class="order_deg">
        <form action="{{ url('confirm_order') }}" method="POST">
            @csrf

            <div class="div-gap">
                <label>Receiver Name:</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" required>
            </div>

            <div class="div-gap">
                <label>Receiver Address:</label>
                <textarea name="address" required>{{ Auth::user()->address }}</textarea>
            </div>

            <div class="div-gap">
                <label>Receiver Phone Number:</label>
                <input type="text" name="phone" value="{{ Auth::user()->phone }}" required>
            </div>

            <div class="div-gap">
                <input type="submit" value="Cash On Delivery" class="btn btn-primary me-5" style="cursor: pointer;">
                <a class="btn btn-success" href="{{ url('stripe',$value) }}">Pay using Card</a>
            </div>
        </form>
    </div>

    @include('home.footer')

</body>

</html>
