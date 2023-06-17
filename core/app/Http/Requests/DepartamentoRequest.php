<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class DepartamentoRequest extends FormRequest{
  public function authorize(){
    return true;
  }
  public function rules(){
    $required = $this->distrito ? '' : 'required';
    return [
      'departamento_code'  => 'required',
      'departamento_name'  => 'required'
    ];
  }
  public function messages(){
    return [
      'departamento_code.required'  => __('Este campo es obligatorio.'),
      'departamento_name.required'  => __('Este campo es obligatorio.')
    ];
  }
}