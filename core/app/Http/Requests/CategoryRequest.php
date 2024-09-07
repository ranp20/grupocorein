<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CategoryRequest extends FormRequest{
    public function authorize(){
        return true;
    }
    public function rules(){
        $id = $this->category ? ',' . $this->category->id : '';
        $required = $this->category ? '' : 'required';
        return [
            'slug'      => [$required,'unique:categories,slug'. $id,'regex:/^[a-zA-Z0-9-]+$/'],
            'photo'     => [$required,'mimes:jpeg,jpg,png,svg,webp,gif,ico,raw,tiff'],
            'name'      => 'required|max:255',
            'meta_keywords'=> 'max:255',
        ];
    }
    public function messages(){
        return [
            'slug.required'  => __('El campo Slug es obligatorio.'),
            'slug.unique'    => __('Esta bala ya ha sido tomada.'),
            'slug.regex'     => __('Slug no debe tener caracteres especiales.'),
            'photo.required' => __('El campo de la imagen es obligatorio.'),
            'photo.mimes'    => __('The image type must be jpeg, jpg, png, svg, webp, gif, ico, raw, tiff.'),
        ];
    }
}