<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->brand ? ',' . $this->brand->id : '';
        $required = $this->brand ? '' : 'required';

        return [
            'photo'      => [$required,'mimes:jpeg,jpg,png,svg'],
            'name'      => 'required|max:255',
            'slug'      => [$required,'unique:brands,slug'. $id,'regex:/^[a-zA-Z0-9-]+$/'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'photo.required'  => __('El campo de la foto es obligatorio.'),
            'photo.mimes'  => __('El formato de archivo de la foto no es compatible.'),
            'slug.required'  => __('El campo Slug es obligatorio.'),
            'slug.unique'    => __('Esta bala ya ha sido tomada.'),
            'slug.regex'     => __('Slug no debe tener caracteres especiales.'),
        ];
    }
}
