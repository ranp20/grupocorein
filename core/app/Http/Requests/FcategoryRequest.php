<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FcategoryRequest extends FormRequest
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
        
        $id = $this->fcategory ? ',' . $this->fcategory->id : '';
        $required = $this->category ? '' : 'required';

        return [
            'slug'  => [$required,'unique:fcategories,slug'. $id,'regex:/^[a-zA-Z0-9-]+$/'],
            'text'  => ['required'],
            'name'  => 'required|max:255',
            'meta_keywords'  => 'max:255',
            'meta_descriptions'  => 'max:255',
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
            'slug.required'  => __('El campo Slug es obligatorio.'),
            'text.required'  => __('El campo de texto es obligatorio.'),
            'slug.unique'    => __('Esta bala ya ha sido tomada.'),
            'slug.regex'     => __('Slug no debe tener caracteres especiales.'),
        ];
    }
}
