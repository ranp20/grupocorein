<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class RootUnitRequest extends FormRequest{
  
  public function authorize(){
    return true;
  }
  public function rules(){
    $id = $this->unitroot ? ',' . $this->unitroot->id : '';
    $required = $this->unitroot ? '' : 'required';
    return [
      'name'      => 'required|max:255',
    ];
  }
}
