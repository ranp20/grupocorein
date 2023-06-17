<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class SettingRequest extends FormRequest{
  public function authorize(){
    return true;
  }
  public function rules(){
    if(isset($this->is_validate)){
      return [
        'title' => 'required|max:255',
        'footer_address' => 'required|max:255',
        'footer_phone' => 'required|max:255',
        'footer_email' => 'required|max:255',
        'copy_right' => 'required|max:255',
        'friday_start' => 'required|max:255',
        'friday_end' => 'required|max:255',
        'satureday_start' => 'required|max:255',
        'satureday_end' => 'required|max:255',
        'logo' => 'mimes:jpeg,jpg,png,svg',
        'loader' => 'mimes:jpeg,jpg,png,svg,gif',
        'favicon' => 'mimes:jpeg,jpg,png,svg,ico',
        'feature_image' => 'mimes:jpeg,jpg,png,svg',
        'home_background' => 'mimes:jpeg,jpg,png,svg',
        'breadcumb_background' => 'mimes:jpeg,jpg,png,svg',
        'footer_background' => 'mimes:jpeg,jpg,png,svg',
        'popup_banner' => 'mimes:jpeg,jpg,png,svg',
        'footer_gateway_img' => 'mimes:jpeg,jpg,png,svg'
      ];
    }else{
      return [];
    }
  }
  public function messages(){
    return [
      'logo.mimes'    => __('El tipo de imagen del logotipo debe ser jpg, jpeg, png, svg.'),
      'loader.mimes'    => __('El tipo de imagen del cargador debe ser jpg, jpeg, png, svg, gif.'),
      'favicon.mimes'    => __('El tipo de imagen de Favicon debe ser jpg, jpeg, png, svg, ico.'),
      'feature_image.mimes'    => __('El tipo de imagen característica debe ser jpg, jpeg, png, svg.'),
      'home_background.mimes'    => __('El tipo de imagen de fondo debe ser jpg, jpeg, png, svg.'),
      'breadcumb_background.mimes'    => __('El tipo de imagen de fondo debe ser jpg, jpeg, png, svg.'),
      'footer_background.mimes'    => __('El tipo de imagen de fondo debe ser jpg, jpeg, png, svg.'),
      'popup_banner.mimes'    => __('El banner emergente debe ser jpg, jpeg, png, svg.'),
    ];
  }
}