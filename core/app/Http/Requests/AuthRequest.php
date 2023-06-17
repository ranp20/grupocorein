<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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

        return [
            'login_email'=> 'required|email',
            'login_password'   => 'required'
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
            'login_email.required' => __('El campo de correo electrónico es obligatorio.'),
            'login_email.email'   => __('El correo electrónico debe ser una dirección de correo electrónico válida.'),
            'login_password.required'    => __('El campo de contraseña es obligatorio.')
        ];
    }

}
