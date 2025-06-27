<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;

class HomeController extends Controller
{
  public function index()
  {
    $user=User::where('usertype','user')->get()->count();
    $product=Product::all()->count();
    $order=Order::all()->count();
    $delivered=Order::where('status','delivered')->count();
    return view('admin.index',compact('user','product','order','delivered'));
  }
  public function home()
  {
    $product=Product::all();
    if(Auth::id()){
      $user=Auth::user();
      $userid=$user->id;
      $count=Cart::where('user_id',$userid)->count();
    }else{
      $count='';
    }
   
    return view('home.index',compact('product','count'));
  }
  public function login_home(){
    $product=Product::all();
    if(Auth::id()){
      $user=Auth::user();
      $userid=$user->id;
      $count=Cart::where('user_id',$userid)->count();
    }else{
      $count='';
    }
    return view('home.index',compact('product','count'));
  }
  public function product_details($id){
    $data=Product::find($id);
    if(Auth::id()){
      $user=Auth::user();
      $userid=$user->id;
      $count=Cart::where('user_id',$userid)->count();
    }else{
      $count='';
    }
    return view('home.product_details',compact('data','count'));
  }

  public function add_cart($id){
    if (Auth::check()) {
      
      $user = Auth::user();
      $product = Product::findOrFail($id);

      $data = new Cart();
      $data->user_id = $user->id;
      $data->product_id = $product->id;
      $data->save();

      return redirect()->back()->with('success', 'Product added to cart!');
  } else {
      return redirect('login');
  }
}
public function mycart()
{
  if(Auth::id()){
    $user=Auth::user();
    $userid=$user->id;
    $count=Cart::where('user_id',$userid)->count();
    $cart=Cart::where('user_id',$userid)->get();
  }else{
    $count='';
  }
  return view('home.mycart',compact('count','cart'));
}
public function remove_cart($id)
{
    
    Cart::where('id', $id)->delete();
    return redirect()->back()->with('success', 'Product removed from cart!');
}
public function confirm_order(Request $request){
  $name=$request->name;
  $address=$request->address;
  $phone=$request->phone;
  $userid=Auth::user()->id;
  $cart=Cart::where('user_id',$userid)->get();
  foreach($cart as $carts){

    $order=new Order;
    $order->name=$name;
    $order->rec_address=$address;
    $order->phone=$phone;
    $order->user_id=$userid;
    $order->product_id=$carts->product_id;
    $order->save();
  }
  $cart_remove=Cart::where('user_id',$userid)->get();
  foreach($cart_remove as $cart_remove){
    $data=Cart::find($cart_remove->id);
    $data->delete();
  }
  // Clear the cart after placing the order
  return redirect()->back()->with('success', 'Order placed successfully!');

  
}
}