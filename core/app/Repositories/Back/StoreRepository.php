<?php
namespace App\Repositories\Back;
use App\{
  Models\Store,
  Helpers\ImageHelper
};
use App\Models\HomeCutomize;

class StoreRepository{
  public function store($request){
    $input = $request->all();
    // $input['photo'] = ImageHelper::handleUploadedImage($request->file('photo'),'assets/images');
    Store::create($input);
  }
  public function update($store, $request){
    $input = $request->all();
    
    // if($file = $request->file('photo')){
    //   $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/assets/images/',$store,'/assets/images/','photo');
    // }

    $store->update($input);
  }
  public function delete($store){
    // ImageHelper::handleDeletedImage($store,'photo','assets/images/');
    $store->delete();
    return ['message' => __('Store Deleted Successfully.'),'status' => 1];
  }
}