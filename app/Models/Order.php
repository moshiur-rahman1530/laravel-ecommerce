<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // protected $fillable=['type','price','status'];
    public $table='orders';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=false;
}
