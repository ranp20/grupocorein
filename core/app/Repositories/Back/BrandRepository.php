<?php
namespace App\Repositories\Back;
use App\{
  Models\Brand,
  Helpers\ImageHelper
};
class BrandRepository{
  public function store($request){
    $input = $request->all();
    if($request->file('photo')){
      $images_name = ImageHelper::ItemhandleUploadedImagePrincipalBrand($request->file('photo'),'assets/images/brands');
      $input['photo'] = $images_name[0];
    }
    Brand::create($input);
  }
  public function update($brand, $request){
    $input = $request->all();
    if($file = $request->file('photo')){
      $images_name = ImageHelper::ItemhandleUpdatedUploadedImagePrincipalBrand($request->photo,'/assets/images/brands/',$brand,'/assets/images/brands/','photo');
      $input['photo'] = $images_name[0];
    }
    $brand->update($input);
  }
  public function delete($brand){
    ImageHelper::handleDeletedImage($brand,'photo','assets/images/brands/');
    $brand->delete();
  }
}