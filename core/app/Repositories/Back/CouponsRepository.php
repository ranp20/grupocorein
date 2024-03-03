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
    if($file = $request->file('photo')){
      $images_name = ImageHelper::ItemhandleUploadedCoupon($request->file('photo'),'assets/images/coupons');
      $input['photo'] = $images_name[0];
      $input['thumbnail'] = $images_name[1];
    }
    Coupons::create($input);
  }

  public function update(Coupons $coupons, $request){
    $input = $request->all();
    $id = $request->id;
    $timeend = $request->date_end;
    $formattedTime = $timeend . ' ' . $request->time_end;
    $input['time_end'] = $formattedTime;
    if ($file = $request->file('photo')) {
      $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/assets/images/coupons/',$coupons,'/assets/images/coupons/','photo');
    }
    $coupons = $this->coupons->findOrFail($id);
    $coupons->update($input);
  }

  public function delete($coupons){
    $coupons->delete();
    return ['message' => __('Coupon Deleted Successfully.'),'status' => 1];    
  }
}
