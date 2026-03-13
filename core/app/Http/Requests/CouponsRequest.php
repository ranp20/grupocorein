<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CouponsRequest extends FormRequest{
  public function authorize(){
    return true;
  }
  public function rules(){
    // $id = $this->coupon ? ',' . $this->coupon->id : '';
    $required = $this->coupon ? '' : 'required';
    return [
      'photo'     => [$required,'mimes:jpeg,jpg,png,svg'],
      'name'      => 'required|max:255',
    ];
  }
}