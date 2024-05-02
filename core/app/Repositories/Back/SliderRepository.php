<?php
namespace App\Repositories\Back;
use App\{
  Models\Slider,
  Helpers\ImageHelper
};
class SliderRepository{
  public function store($request){
    $input = $request->all();
    $input['photo'] = ImageHelper::handleUploadedImageSlider($request->file('photo'),'assets/images/sliders');
    $input['logo'] = ImageHelper::handleUploadedImageSlider($request->file('logo'),'assets/images/sliders');
    Slider::create($input);
  }
  public function update($slider, $request){
    $input = $request->all();
    if($file = $request->file('photo')){
      $input['photo'] = ImageHelper::handleUpdatedUploadedImageSlider($file,'/assets/images/sliders/',$slider,'/assets/images/sliders/','photo');
    }
    if ($file = $request->file('logo')){
      $input['logo'] = ImageHelper::handleUpdatedUploadedImageSlider($file,'/assets/images/sliders/',$slider,'/assets/images/sliders/','logo');
    }
    $slider->update($input);
  }
  public function delete($slider){
    ImageHelper::handleDeletedImage($slider,'photo','assets/images/sliders/');
    ImageHelper::handleDeletedImage($slider,'logo','assets/images/sliders/');
    $slider->delete();
  }
}