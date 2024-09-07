<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ImageStoreRequest extends FormRequest{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'photo' => 'mimes:jpeg,jpg,png,svg,webp,gif,ico,raw,tiff'
        ];
    }
    public function messages(){
        return [
            'photo.required' => __('El campo de la imagen es obligatorio.'),
            'photo.mimes'    => __('The image type must be jpeg, jpg, png, svg, webp, gif, ico, raw, tiff.')
        ];
    }
}