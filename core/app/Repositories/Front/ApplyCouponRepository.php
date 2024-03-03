<?php
namespace App\Repositories\Front;
use App\{
  Models\ApplyCoupon,
  Models\Coupons,
  Models\Cart,
  Models\Tax,
  Models\Item,
  Models\User
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class ApplyCouponRepository{
  public function addToUser($request){
    $input = $request;
    $applycoupon = new ApplyCoupon;
    $applycoupon->fill($input)->save();
  }
}
