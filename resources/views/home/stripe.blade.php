<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
    </style>
</head>
<body>
    @if (session('success'))
        <h3 style="color:green;">{{ session('success') }}</h3>
    @endif

    @if (session('error'))
        <h3 style="color:red;">{{ session('error') }}</h3>
    @endif

    <form action="{{ route('stripe.post') }}" method="POST" id="payment-form">
        @csrf
        <div>
            <label for="name">Your Name</label><br>
            <input type="text" name="name" required><br><br>

            <label for="email">Your Email</label><br>
            <input type="email" name="email" required><br><br>
            <label for="address">Address</label><br>
            <input type="text" name="address" required><br><br>

            <label for="phone">Phone</label><br>
            <input type="text" name="phone" required><br><br>

        </div>

        <label for="card-element">Card details</label><br>
        <div id="card-element" class="StripeElement">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <div id="card-errors" role="alert" style="color:red;"></div><br>

        <button type="submit">Pay $100</button>
    </form>

    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}"); // publishable key
        const elements = stripe.elements();

        const card = elements.create("card", {
            style: {
                base: {
                    color: "#32325d",
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "16px",
                    "::placeholder": { color: "#aab7c4" }
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
