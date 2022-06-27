<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
      $result = Category::all();
        return view('admin.Category',['category'=>$result]);
    }


      public function catbyproduct()
      {
        // $id =$request->input('id');
        // $categoryCount = Product::where('product_cat', $id)->count();
        // return $categoryCount;

        // $products = DB::table('products')
        // ->leftjoin('categories','categories.id','=','products.product_cat')
        // ->selectRaw('COUNT(*) as cat', 'products.*')
        // ->groupBy('products.id')
        // ->get();
      }

    public function store(Request $request)
    {
        $name = $request->input('catName');
        $desc = $request->input('catDes');
        $img = $request->input('catImg');
        $status = $request->input('status');
        $result = Category::insert(['cat_name'=>$name, 'cat_des'=>$desc, "cat_img"=>$img,'status'=>$status]);
        if ($result==true) {
          return 1;
        } else {
          return 0;
        }

    }


// get allcategory

public function allcategory()
{
  $result = Category::all();
  return $result;
}
// delete categoryDelete

    public function categoryDelete(Request $req)
    {
      $id = $req->input('id');
      $result = Category::where('id','=',$id)->delete();
      if ($result==true) {
        return 1;
      } else {
        return 0;
      }
    }

}
