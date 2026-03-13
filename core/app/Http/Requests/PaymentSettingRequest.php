<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class PaymentSettingRequest extends FormRequest{
  public function authorize(){
    return true;
  }
  public function rules(){
    return [
      'photo'  => 'mimes:jpeg,jpg,png,svg,webp,gif,ico,raw,tiff'
    ];
  }
  public function messages(){
    return [
      'photo.mimes'    => __('The image type must be jpeg, jpg, png, svg, webp, gif, ico, raw, tiff.')
    ];
  }
}