<?php
namespace App\Repositories\Back;
use App\{
  Models\Brand
};
use App\Helpers\ImageHelper;
class BrandRepository{
  public function store($request){
    $input = $request->all();
    if($file = $request->file('photo')){
      $input['photo'] = ImageHelper::handleUploadedImage($file,'assets/images/brands');
    }
    Brand::create($input);
  }
  public function update($brand, $request){
    $input = $request->all();
    if($file = $request->file('photo')){
      $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file,'/assets/images/brands',$brand,'/assets/images/brands/','photo');
    }
    $brand->update($input);
  }
  public function delete($brand){
    ImageHelper::handleDeletedImage($brand,'photo','assets/images/brands/');
    $brand->delete();
  }
}