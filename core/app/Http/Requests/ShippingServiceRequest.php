<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $conditin = isset($this->shipping->id) && $this->shipping->id == 1 ? '' : 'required';
        return  [
           'title' => 'required|max:255',
           'provincia_id'  => 'required',
           'ciudad_id'  => 'required',
           'distrito_id'  => 'required',
           'price'  => $conditin.'|numeric|max:999',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('El campo de título es obligatorio.'),
            'provincia_id.required'  => __('El campo de Provincia es obligatorio.'),
            'ciudad_id.required'  => __('El campo de Ciudad es obligatorio.'),
            'distrito_id.required'  => __('El campo de Distrito es obligatorio.')
        ];
    }
}
