<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f6f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        form {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }

        h3 {
            text-align: center;
            font-weight: 500;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #333;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: rgb(86, 150, 140);
            box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
            transition: box-shadow 150ms ease;
            margin-bottom: 16px;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        button {
            background: #6772e5;
            color: #fff;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #5469d4;
        }

        #card-errors {
            color: #fa755a;
            margin-top: -10px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .status-message {
            text-align: center;
            margin-bottom: 16px;
        }

        .status-message.success {
            color: green;
        }

        .status-message.error {
            color: red;
        }
    </style>
</head>
<body>
    
    <form action="{{ route('stripe.post',$value) }}" method="POST" id="payment-form">
        @csrf

        @if (session('success'))
            <div class="status-message success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="status-message error">{{ session('error') }}</div>
        @endif
        <h1>Stripe Payment</h1>
        <h4>You need to pay ${{$value}}</h4>
        <label for="name">Your Name</label>
        <input type="text" name="name" required>

        <label for="email">Your Email</label>
        <input type="email" name="email" required>

        <label for="address">Address</label>
        <input type="text" name="address" required>

        <label for="phone">Phone</label>
        <input type="text" name="phone" required>

        <label for="card-element">Card Details</label>
        <div id="card-element" class="StripeElement">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <div id="card-errors" role="alert"></div>

        <button type="submit">Pay Now</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
       const stripe = Stripe("{{ $stripe_key }}");
        const elements = stripe.elements();
        const card = elements.create("card", {
            style: {
                base: {
                    color: "#32325d",
                    fontFamily: '"Roboto", sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "16px",
                    "::placeholder": {
                        color: "#aab7c4"
                    }
                },
                invalid: {
                    color: "#fa755a",
                    iconColor: "#fa755a"
                }
            }
        });

        card.mount("#card-element");

        const form = document.getElementById("payment-form");
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
    console.log(result);
    if (result.error) {
        document.getElementById("card-errors").textContent = result.error.message;
    } else {
         const hiddenInput = document.createElement("input");
                    hiddenInput.setAttribute("type", "hidden");
                    hiddenInput.setAttribute("name", "stripeToken");
                    hiddenInput.setAttribute("value", result.token.id);
                    form.appendChild(hiddenInput);

                    form.submit();
    }
});
        });
    </script>
</body>
</html>
