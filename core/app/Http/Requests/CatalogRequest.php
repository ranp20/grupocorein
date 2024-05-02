<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CatalogRequest extends FormRequest{
  public function authorize(){
    return true;
  }
  public function rules(){
    $id = $this->catalog ? ',' . $this->catalog->id : '';
    $required = $this->catalog ? '' : 'required';
    return [
      'name'      => 'required|max:255',
    ];
  }
}