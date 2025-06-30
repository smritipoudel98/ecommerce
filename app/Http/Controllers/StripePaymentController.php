<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Cart;

use Illuminate\Http\Request;
use Stripe;
class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('home.stripe'); // Your stripe form view
    }
 public function stripePost(Request $request)
{
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
        $charge = \Stripe\Charge::create([
            "amount" => 10000,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from Laravel app",
            "metadata" => [
                "name" => $request->name,
                "email" => $request->email ?? 'no@email.com',
            ]
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        foreach ($cartItems as $cart) {
            $order = new Order();
            $order->user_id = Auth::id();
            $order->name = $request->name;
            $order->rec_address = $request->address ?? 'N/A';
            $order->phone = $request->phone ?? 'N/A';
            $order->product_id = $cart->product_id;
            $order->payment_status = 'paid';

            if ($order->save()) {
                \Log::info('✅ Order saved', ['order_id' => $order->id]);
            } else {
                \Log::error('❌ Failed to save order', ['user_id' => Auth::id()]);
            }
        }

        Cart::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Payment successful!');
    } catch (\Exception $e) {
        return back()->with('error', 'Error: ' . $e->getMessage());
    }
}
}