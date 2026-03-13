<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ApplyCoupon extends Model{
    protected $table = 'tbl_applycoupons';
    protected $fillable = ['id_user','id_prod','id_coupon','totalprice'];
    public $timestamps = false;
}
