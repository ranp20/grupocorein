<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TempCart extends Model{
  protected $table = 'tbl_temp_carts';
  protected $fillable = [
    'user_id',
    'item_id',
    'name',
    'slug',
    'sku',
    'brand_id',
    'quantity',
    'price',
    'main_price',
    'photo',
    'is_type',
    'item_type'
  ];
  public $timestamps = false;
}