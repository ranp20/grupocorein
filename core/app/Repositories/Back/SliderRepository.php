<?php
namespace App\Repositories\Back;
use App\{
  Models\Slider,
  Helpers\ImageHelper
};
class SliderRepository{
  public function store($request){
    // echo "<pre>";
    // print_r($request->all());
    // echo "</pre>";
    // exit();
    $input = $request->all();
    $content_check = ($request->has('content_check') && $request->content_check == 1) ? 'false' : 'true';
    $content_alignment = ($request->has('content_alignment')) ? $request->content_alignment : '';
    $content_title = ($request->has('content_title')) ? $request->content_title : 'Banner de prueba 001';
    $content_description = ($request->has('content_description')) ? $request->content_description : 'Descripción del banner 001';
    $content_btncheck = ($request->has('content_btncheck')) ? $request->content_btncheck : 'off';
    $content_btn_title = ($request->has('content_btn_title')) ? $request->content_btn_title : '';
    $content_btn_link = ($request->has('content_btn_link')) ? $request->content_btn_link : '';
    $input['content_check'] = $content_check;
    $content_config = [
      'content_alignment' => $content_alignment,
      'content_title' => $content_title,
      'content_description' => $content_description,
      'content_btncheck' => $content_btncheck,
      'content_btn_title' => $content_btn_title,
      'content_btn_link' => $content_btn_link
    ];
    $input['content_info'] = json_encode($content_config, TRUE);
    $input['photo'] = ImageHelper::handleUploadedImageSlider($request->file('photo'),'assets/images/sliders');
    $input['logo'] = ImageHelper::handleUploadedImageSlider($request->file('logo'),'assets/images/sliders');
    Slider::create($input);
  }
  public function update($slider, $request){
    // echo "<pre>";
    // print_r($request->all());
    // echo "</pre>";
    // exit();
    $input = $request->all();
    $content_check = ($request->has('content_check') && $request->content_check == 1) ? 'false' : 'true';
    $content_alignment = ($request->has('content_alignment')) ? $request->content_alignment : '';
    $content_title = ($request->has('content_title')) ? $request->content_title : 'Banner de prueba 001';
    $content_description = ($request->has('content_description')) ? $request->content_description : 'Descripción del banner 001';
    $content_btncheck = ($request->has('content_btncheck')) ? $request->content_btncheck : 'off';
    $content_btn_title = ($request->has('content_btn_title')) ? $request->content_btn_title : 'Click Aquí';
    $content_btn_link = ($request->has('content_btn_link')) ? $request->content_btn_link : '#';
    $input['content_check'] = $content_check;
    $content_config = [
      'content_alignment' => $content_alignment,
      'content_title' => $content_title,
      'content_description' => $content_description,
      'content_btncheck' => $content_btncheck,
      'content_btn_title' => $content_btn_title,
      'content_btn_link' => $content_btn_link
    ];
    $input['content_info'] = json_encode($content_config, TRUE);

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