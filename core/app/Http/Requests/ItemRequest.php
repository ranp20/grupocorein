<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ItemRequest extends FormRequest{
    
    public function authorize(){
      return true;
    }

    public function rules(){

      $type_required = $this->item_type == 'digital' || $this->item_type == 'license' ? '' : 'required';

      $check_link = $this->file_type == 'link' ? 'required' : '';
      if($this->item_type == 'digital'){
        if($this->item){
          $check_file = '';
        }else{
          $check_file = $this->item_type == 'digital' && $this->file_type == 'file' ? 'required' : '';
        }
      }elseif($this->item_type == 'license'){
        if($this->item){
          $check_file = '';
        }else{
          $check_file = $this->item_type == 'license' && $this->file_type == 'file' ? 'required' : '';
        }
      }else{
        $check_file = '';
      }
      $id = $this->item ? ',' . $this->item->id : '';
      $required = $this->item ? '' : 'required|';

      return [
        'name'            => 'required|max:255',
        'slug'            => 'required','unique:items,slug' . $id, 'regex:/^[a-zA-Z0-9-]+$/',
        'category_id'     => 'required',
        'link'            => $check_link,
        'file'            => $check_file.'|file|mimes:zip',
        'sort_details'    => 'required',
        'discount_price'  => 'required|max:50',
        'previous_price'  => 'max:50',
        'stock'           => 'numeric|max:9999999999',
        'tax_id'          => 'required',
        'photo'           => $required, 'mimes:jpeg,jpg,png,svg'
      ];
    }

    public function messages(){

      return [
        'name.required'            =>  __('El campo de nombre es obligatorio.'),
        'tax_id.required'          =>  __('El campo de impuestos es obligatorio.'),
        'category_id.required'     =>  __('El campo de categoría es obligatorio.'),
        'brand_id.required'        =>  __('El campo de la marca es obligatorio.'),
        'slug.required'            =>  __('El campo Slug es obligatorio.'),
        'slug.unique'              =>  __('Esta bala ya ha sido tomada.'),
        'sort_details.required'    =>  __('El campo Descripción de clasificación es obligatorio.'),
        'discount_price.required'  =>  __('El campo Precio actual es obligatorio.'),
        'stock.required'           =>  __('El campo de Stock debe ser numérico mayor a 0.'),
        'stock.required'           =>  __('El campo de existencias es obligatorio.'),
        'photo.required'           =>  __('El campo de la imagen es obligatorio.'),
        'photo.mimes'              =>  __('El tipo de imagen debe ser jpg, jpeg, png, svg.')
      ];
    }

}
