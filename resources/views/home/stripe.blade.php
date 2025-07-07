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

        h1, h4 {
            text-align: center;
            margin: 0 0 20px;
        }

        h4 {
            color: #666;
            font-weight: normal;
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

        #card-element {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: white;
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

        button:disabled {
            background: #aaa;
            cursor: not-allowed;
        }

        #card-errors {
            color: #fa755a;
            margin: -10px 0 15px;
            font-size: 14px;
            min-height: 18px;
        }

        .status-message {
            text-align: center;
            margin-bottom: 16px;
            padding: 10px;
            border-radius: 4px;
        }

        .status-message.success {
            color: green;
            background-color: #e6ffe6;
        }

        .status-message.error {
            color: red;
            background-color: #ffebeb;
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    @if(empty($stripe_key))
        <div class="status-message error">
            Stripe key is missing! Check your .env file for STRIPE_KEY
        </div>
    @endif

    <form action="{{ route('stripe.post', $value) }}" method="POST" id="payment-form">
        @csrf

        @if (session('success'))
            <div class="status-message success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="status-message error">{{ session('error') }}</div>
        @endif

        <h1>Stripe Payment</h1>
        <h4>You need to pay ${{ number_format($value, 2) }}</h4>

        <label for="name">Your Name</label>
        <input type="text" name="name" required>

        <label for="email">Your Email</label>
        <input type="email" name="email" required>

        <label for="address">Address</label>
        <input type="text" name="address" required>

        <label for="phone">Phone</label>
        <input type="text" name="phone" required>

        <label>Card Details</label>
        <div id="card-element">
            <!-- Stripe will insert the card elements here -->
        </div>
        <div id="card-errors" role="alert"></div>

        <button type="submit" id="submit-button">Pay Now</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Debug output
            console.log("Stripe Key:", "{{ $stripe_key }}");
            
            if (!"{{ $stripe_key }}") {
                document.getElementById('card-errors').textContent = 
                    'Payment system not configured. Please try again later.';
                document.getElementById('submit-button').disabled = true;
                return;
            }

            const stripe = Stripe("{{ $stripe_key }}");
            const elements = stripe.elements();
            
            const card = elements.create('card', {
                style: {
                    base: {
                        color: '#32325d',
                        fontFamily: '"Roboto", sans-serif',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                }
            });

            card.mount('#card-element');

            card.addEventListener('change', function(event) {
                const displayError = document.getElementById('card-errors');
                displayError.textContent = event.error ? event.error.message : '';
            });

            const form = document.getElementById('payment-form');
            form.addEventListener('submit', async function(event) {
                event.preventDefault();
                
                const submitButton = document.getElementById('submit-button');
                submitButton.disabled = true;
                submitButton.textContent = 'Processing...';

                const {token, error} = await stripe.createToken(card);

                if (error) {
                    document.getElementById('card-errors').textContent = error.message;
                    submitButton.disabled = false;
                    submitButton.textContent = 'Pay Now';
                } else {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token.id);
                    form.appendChild(hiddenInput);
                    
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>