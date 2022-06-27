<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cat = Category::all();
      $subcat = SubCategory::all();
      $brand = Brand::all();
      $unit = Unit::all();
      // $size = json_decode(Size::all());
      $size = Size::all();
      $color = Color::all();
        return view('admin.Product',['cat'=>$cat,'subcat'=>$subcat,'brand'=>$brand,'unit'=>$unit,'sizes'=>$size,'color'=>$color]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p_name = $request->input('name');
        $p_desc = $request->input('des');
        $p_price = $request->input('price');
        $p_dis = $request->input('discount');
        $p_cat = $request->input('cat');
        $p_subcat = $request->input('subcat');
        $p_brand = $request->input('brand');

        // if ($request->input('color')) {
        //     foreach ($request->input('color') as  $value) {
        //         $p_color = $value;
        //     }
        // }
        //
        // if ($request->input('size')) {
        //     foreach ($request->input('size') as  $value) {
        //         $p_size = $value;
        //     }
        // }
        $p_color = json_encode($request->input('color'));
        $p_size = json_encode($request->input('size'));

        // $p_color = $request->input('color');
        // $p_size = $request->input('size');
        $p_unit = $request->input('unit');
        $p_qtn = $request->input('qtn');
        $p_img = $request->input('img');
        $feature = $request->input('feature');
        $condition = $request->input('condition');
        $status = $request->input('status');

        $result = Product::insert(['product_name'=>$p_name,'product_des'=>$p_desc,'product_cat'=>$p_cat,'product_price'=>$p_price,'discount'=>$p_dis,'subcat_id'=>$p_subcat,'brand_id'=>$p_brand,'color_id'=>$p_color,'size_id'=>$p_size,'unit_id'=>$p_unit,'product_quantity'=>$p_qtn,'product_img'=>$p_img,'is_featured'=>$feature,'condition'=>$condition,'status'=>$status]);
        if ($result==true) {
          return 1;
        } else {
          return 0;
        }
      }

    // get all product

    public function allproducts()
    {
      $result = Product::all();
      return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
