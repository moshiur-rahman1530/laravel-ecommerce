<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table='products';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=false;


    public static function CountCategory($id)
    {
      $categoryCount = Product::where('product_cat', $id)->count();
      return $categoryCount;
    }
}
