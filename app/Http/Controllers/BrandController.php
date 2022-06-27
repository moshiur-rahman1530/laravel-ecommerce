<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
  public function index()
  {

    $brands = Brand::all();
      return view('admin.Brand',['brands'=>$brands]);
  }


  public function store(Request $request)
  {
      $name = $request->input('name');
      $desc = $request->input('description');
      $img = $request->input('img');
      $status = $request->input('status');
      $result = Brand::insert(['name'=>$name, 'description'=>$desc, "img"=>$img,'status'=>$status]);
      if ($result==true) {
        return 1;
      } else {
        return 0;
      }

  }

  // details SubCatTableBody
  public function brandsDetails(Request $req)
  {
    $id = $req->input('id');
    $data=json_encode(Brand::where('id','=',$id)->get());
      return $data;

  }

  // update sub category
  public function updateBrand(Request $req)
  {
    $id = $req->input('id');
    $name = $req->input('name');
    $description = $req->input('description');
    $img = $req->input('img');
    $status = $req->input('status');
    $result= Brand::where('id','=',$id)->update([
     	'name'=>$name,
     	'description'=>$description,
     	'img'=>$img,
     	'status'=>$status,
     ]);

     if($result==true){
       return 1;
     }
     else{
      return 0;
     }
  }


  // change sub cat Status

  public function brandsStatus(Request $req){
      $id = $req->input('id');
      // $getCategory = Category::find($id);
      $data = Brand::where('id',$id)->first();
      if ($data->status == 1) {
        $status = 0;
      } else {
        $status = 1;
      }
      $result = Brand::where('id',$id)->update(['status'=>$status]);
          if ($result==true) {
            return 1;
          } else {
            return 0;
          }
  }


// get allcategory

public function allbrands()
{
  $result = Brand::all();
  return $result;
}
// delete categoryDelete

  public function brandsDelete(Request $req)
  {
    $id = $req->input('id');
    $result = Brand::where('id','=',$id)->delete();
    if ($result==true) {
      return 1;
    } else {
      return 0;
    }
  }

}
