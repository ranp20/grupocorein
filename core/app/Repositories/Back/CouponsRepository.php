<?php
namespace App\Repositories\Back;
use App\{
  Models\Coupons,
  Helpers\ImageHelper
};
use App\Models\HomeCutomize;
class CouponsRepository{
  protected $coupons;
  public function __construct(Coupons $coupons){
    $this->coupons = $coupons;
  }
  public function store($request){ 
    $input = $request->all();
    $timeend = $request->date_end;
    $formattedTime = $timeend . ' ' . $request->time_end;
    $input['time_end'] = $formattedTime;
    if($request->file('photo')){
      $input['photo'] = ImageHelper::ItemhandleUploadedCoupon($request->file('photo'),'assets/images/coupons');
    }
    Coupons::create($input);
  }
  public function update(Coupons $coupons, $request){
    $input = $request->all();
    $id = $request->id;
    $coupons = $this->coupons->findOrFail($id);
    $timeend = $request->date_end;
    $formattedTime = $timeend . ' ' . $request->time_end;
    $input['time_end'] = $formattedTime;
    if($request->file('photo')){
      $input['photo'] = ImageHelper::handleUpdatedUploadedCoupon($request->file('photo'),'/assets/images/coupons',$coupons,'/assets/images/coupons/','photo');
    }
    $coupons->update($input);
  }
  public function delete($coupons){
    $coupons->delete();
    return ['message' => __('Coupon Deleted Successfully.'),'status' => 1];    
  }
}