<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  public function __construct()
{
    $this->middleware('auth');
}
  public function addToCartProduct(Request $req)
  {
      $id = $req->input('id');
      $quantity = $req->input('quantity');
      // $user = Auth::user();
      $userId = Auth::id();
      $size =$req->input('size');
      $color =$req->input('color');
      $UserIP=$_SERVER['REMOTE_ADDR'];
      $checkProduct=Cart::where('product_id',$id)->where('user_id',$userId)->first();
      $product = Product::find($id);
      if ($checkProduct) {
        return 1;
      }else if(!$checkProduct){
        $cart = new Cart();
        $cart->user_id=$userId;
        $cart->product_id=$id;
        $cart->product_name=$product->product_name;
        $cart->product_price=$product->product_price;
        $cart->qtn=$quantity;
        $cart->product_cat=$product->product_cat;
        $cart->product_subcat=$product->subcat_id;
        $cart->image=$product->product_img;
        $cart->product_brand=$product->brand_id;
        $cart->product_size=$size;
        $cart->product_color=$color;
        $cart->discount=$product->discount;
        $cart->product_unit=$product->unit_id;
        $cart->ip=$UserIP;
        $cart->save();
        return 2;
      }else{
        return 0;
      }
  }

//   public function GetVisitor()
//  {
//      $UserIP=$_SERVER['REMOTE_ADDR'];
//      date_default_timezone_set("Asia/Dhaka");
//      $timeDate= date("Y-m-d h:i:sa");
//      Visitor::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);
//      return view('welcome');
//  }


// public function ShippingCartDetails()
// {
//   $userid = Auth::id();
//   $findallProduct = Cart::where('user_id',$userid)->get();
//   // dd($findallProduct);
//   return view('cart',['cartProduct'=>$findallProduct]);
// }
public function ShippingCartDetailsPage()
{
  return view('cart');
}


public function ShippingCartDetails()
{
  $userid = Auth::id();
  $findallProduct = Cart::where('user_id',$userid)->get();
  // dd($findallProduct);
  return $findallProduct;
}


// increase cart quantity

public function cartIncrement(Request $req)
{
  $id = $req->input('id');
  $findProduct = Cart::where('id', $id)->first();
  $qtn = $findProduct->qtn;
  $upqtn = $qtn+1;
  if($upqtn>5){
    return 2;
  }
  $result = Cart::where('id','=', $id)->update(['qtn'=>$upqtn]);
  if ($result==true) {
    return 1;
  } else {
    return 0;
  }
  
}
// decrease cart quantity
public function cartDecrement(Request $req)
{
  $id = $req->input('id');
  $findProduct = Cart::where('id', $id)->first();
  // $qtn = $req->input('qtn');
  $qtn = $findProduct->qtn;
  $upqtn = $qtn-1;
  if($upqtn<=0){
    return 2;
  }
  $result = Cart::where('id','=', $id)->update(['qtn'=>$upqtn]);
  if ($result==true) {
    return 1;
  } else {
    return 0;
  }
  
}

// cart remove item
public function cartDelete(Request $req)
{
  $id = $req->input('id');
  $result = Cart::where('id','=', $id)->delete();
  if ($result==true) {
    return 1;
  } else {
    return 0;
  }
}


// total count cart

public function allCartItem()
{
  $userId = Auth::id();
  if ($userId) {
    $result = Cart::where('user_id','=',$userId)->count();
    return $result;
  }else{
    return 0;
  }
}
// total count cart

public function subtotal()
{
  $userId = Auth::id();
  if ($userId) {
    $result = Cart::where('user_id','=',$userId)->select('product_price')->sum();
    return $result;
  }else{
    return 0;
  }
}

}
