<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
  public function index()
  {

    $category = Category::all();
      return view('admin.SubCategory',['category'=>$category]);
  }


  public function store(Request $request)
  {
      $name = $request->input('name');
      $desc = $request->input('description');
      $cat = $request->input('cat_id');
      $img = $request->input('img');
      $status = $request->input('status');
      $result = SubCategory::insert(['name'=>$name, 'description'=>$desc,'cat_id'=>$cat, "img"=>$img,'status'=>$status]);
      if ($result==true) {
        return 1;
      } else {
        return 0;
      }

  }

  // details SubCatTableBody
  public function subCatDetails(Request $req)
  {
    $id = $req->input('id');
    $data=json_encode(SubCategory::where('id','=',$id)->get());
      return $data;

  }

  // update sub category
  public function updateSubCat(Request $req)
  {
    $id = $req->input('id');
    $name = $req->input('name');
    $description = $req->input('description');
    $catId = $req->input('catId');
    $img = $req->input('img');
    $status = $req->input('status');
    $result= SubCategory::where('id','=',$id)->update([
     	'name'=>$name,
     	'description'=>$description,
     	'cat_id'=>$catId,
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

  public function subcategoryStatus(Request $req){
      $id = $req->input('id');
      // $getCategory = Category::find($id);
      $data = SubCategory::where('id',$id)->first();
      if ($data->status == 1) {
        $status = 0;
      } else {
        $status = 1;
      }
      $result = SubCategory::where('id',$id)->update(['status'=>$status]);
          if ($result==true) {
            return 1;
          } else {
            return 0;
          }
  }


// get allcategory

public function allsubcategory()
{
$result = SubCategory::all();
return $result;
}
// delete categoryDelete

  public function subcategoryDelete(Request $req)
  {
    $id = $req->input('id');
    $result = SubCategory::where('id','=',$id)->delete();
    if ($result==true) {
      return 1;
    } else {
      return 0;
    }
  }

}
