<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Shipping;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
      $category = Category::with('subcategories')->get();
      $subcat = SubCategory::all();
      $allProduct= Product::all();
      $latestProduct= Product::orderBy('id','desc')->get();

      $data = DB::table('categories')->leftjoin('products', 'categories.id','=','products.product_cat')-> get();
      // return $category;

      return view('home', ['category'=>$category, 'data'=>$data,'allProduct'=>$allProduct, 'newArive'=>$latestProduct,'subcat'=>$subcat]);
    }

    // public function getProductByCategory(Request $req)
      public function getProductByCategory()
    {

      // $data = DB::table('categories')->leftjoin('products', 'categories.id','=','products.product_cat')-> get();
      $category = Category::all();
      // $cat = $req->Category;
      // $category = Category::select('id')->get();
      $product = Product::where('product_cat',$category)->get();
      // return $product;
      return $category;
    }



    // category ldap_control_paged_result
    public function categoryPage(Request $req)
    {
      $id=$req->id;
      $category = Category::all();
      $catName = Category::find($id);
      $product = Product::where('product_cat',$id)->get();
      return view('categoryPage', ['category'=>$category, 'product'=>$product,'catName'=>$catName]);
    }

    // shipping page
    public function checkoutPage(Request $req)
    {
      $id=$req->id;
      $userId = Auth::id();
      $category = Category::all();
      $shipping = Shipping::all();
      $cart = Cart::where('user_id','=',$userId)->get();
      $catName = Category::find($id);
      $product = Product::where('product_cat',$id)->get();
      return view('shippingPage', ['category'=>$category, 'product'=>$product,'catName'=>$catName,'carts'=>$cart,'shipping'=>$shipping]);
    }
    // cart page
    public function ShippingCartDetailsPage(Request $req)
    {
      $id=$req->id;
      $category = Category::all();
      $shipping = Shipping::all();
      $catName = Category::find($id);
      $product = Product::where('product_cat',$id)->get();
      return view('cart', ['category'=>$category, 'product'=>$product,'catName'=>$catName,'shipping'=>$shipping]);
    }
  

        // sub category all products
        public function SubCategoryPage(Request $req)
        {
          $id=$req->id;
          $subcat = SubCategory::all();
          $cat = Category::all();
          $subcatname = SubCategory::find($id);
          $catName = Category::find($subcatname->cat_id);
          $product = Product::where('subcat_id',$id)->get();
          return view('SubCategoryPage', ['category'=>$cat,'subcat'=>$subcat, 'product'=>$product,'catName'=>$catName,'subcatname'=>$subcatname]);
        }


        // detailss product show
        public function detailsProduct(Request $req)
        {

          $socialShare = \Share::page(
              'https://www.nicesnippets.com/blog/laravel-custom-foreign-key-name-example',
              'Laravel Custom Foreign Key Name Example',
          )
          ->facebook()
          ->twitter()
          ->linkedin()
          ->whatsapp()
          ->telegram();



          $id=$req->id;
          $cat = Category::all();
          $subcatname = SubCategory::find($id);
          $product = Product::where('subcat_id',$id)->get();
          $detailsProduct = Product::where('id',$id)->first();
          return view('detailsProduct', ['category'=>$cat, 'product'=>$product,'subcatname'=>$subcatname,'detailsProduct'=>$detailsProduct,'socialShare'=>$socialShare]);
        }
}
