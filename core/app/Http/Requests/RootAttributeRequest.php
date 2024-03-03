<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class RootAttributeRequest extends FormRequest{
  
  public function authorize(){
    return true;
  }
  public function rules(){
    $id = $this->attributeroot ? ',' . $this->attributeroot->id : '';
    $required = $this->attributeroot ? '' : 'required';
    return [
      'name'      => 'required|max:255',
    ];
  }
}
