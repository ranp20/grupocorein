<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class PaymentSettingRequest extends FormRequest{
  public function authorize(){
    return true;
  }
  public function rules(){
    return [
      'photo'  => 'mimes:jpeg,jpg,png,svg'
    ];
  }
  public function messages(){
    return [
      'photo.mimes'    => __('El tipo de imagen debe ser jpg, jpeg, png, svg.')
    ];
  }
}