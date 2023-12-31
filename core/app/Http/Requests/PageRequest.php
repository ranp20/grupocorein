<?php

namespace App\Http\Requests;

use Illuminate\{
    Validation\Rule,
    Foundation\Http\FormRequest
};


class PageRequest extends FormRequest
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

        $mains = ['shop','contact','blog','cart','checkout'];

        $id = $this->page ? ',' . $this->page->id : '';

        return  [
            'title'  => 'required|max:255',
            'slug' => 'required|max:255|regex:/^[a-zA-Z0-9-]+$/', Rule::notIn($mains) , 'unique:pages,slug' . $id,
            'details'  => 'required',
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
            'slug.required' => __('El campo Slug es obligatorio.'),
            'slug.unique'   => __('Esta bala ya ha sido tomada.'),
            'slug.not_in'    => __('No puedes usar este slug.')
        ];
    }


}
