<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ProvinciaRequest extends FormRequest{
  public function authorize(){
    return true;
  }
  public function rules(){
    $id = $this->provincia ? ',' . $this->provincia->id : '';
    $required = $this->provincia ? '' : 'required';
    return [
      'departamento_code'  => 'required',
      'provincia_code'  => 'required',
      'provincia_name'  => 'required'
    ];
  }
  public function messages(){
    return [
      'provincia_code.required'  => __('Este campo es obligatorio.'),
      'provincia_name.required'  => __('Este campo es obligatorio.')
    ];
  }
}