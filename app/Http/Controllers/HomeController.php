<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;

class HomeController extends Controller
{
  public function index()
  {
    return view('admin.index');
  }
  public function home()
  {
    $product=Product::all();
    return view('home.index',compact('product'));
  }
  public function login_home(){
    $product=Product::all();
    return view('home.index',compact('product'));
  }
  public function product_details($id){
    $data=Product::find($id);
    return view('home.product_details',compact('data'));
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
}