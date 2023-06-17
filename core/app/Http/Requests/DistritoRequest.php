<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class DistritoRequest extends FormRequest{
  public function authorize(){
    return true;
  }
  public function rules(){
    $required = $this->distrito ? '' : 'required';
    return [
      'departamento_code'  => 'required',
      'provincia_code'  => 'required',
      'distrito_code'  => 'required',
      'distrito_name'  => 'required'
    ];
  }
  public function messages(){
    return [
      'distrito_code.required'  => __('Este campo es obligatorio.'),
      'distrito_name.required'  => __('Este campo es obligatorio.')
    ];
  }
}