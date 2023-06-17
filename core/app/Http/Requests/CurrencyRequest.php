<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
        $id = $this->currency ? ',' . $this->currency->id : '';
        $required = $this->currency ? '' : 'required';

        return [
            'name'      => $required.'|max:10|unique:currencies,name'. $id,
            'sign'      => 'required',
            'value'    =>   'required|numeric|max:50000'
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
            'name.required'  => __('El campo de nombre es obligatorio.'),
            'name.unique'    => __('Este nombre de moneda ya se ha tomado.'),
            'sign.required'     => __('El campo de signo de moneda es obligatorio.'),
            'value.required'     => __('El campo de valor de moneda es obligatorio.'),
        ];
    }
}
