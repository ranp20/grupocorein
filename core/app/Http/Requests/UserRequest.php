<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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

        $id = Auth::check() ? ',' . Auth::user()->id : '';
        // $reg_enterprise = (Auth::user()->reg_enterprise != "") ? 'off' : Auth::user()->reg_enterprise;
        $setting = Setting::first();
        $password = Auth::check() ? '' : 'required|';
        $check = Auth::check() ? 'nullable|min:6|max:16' : "min:6|max:16|confirmed";

        return [
            'g-recaptcha-response' => $setting->recaptcha == 1 ?  $password : '',
            'first_name' => $password.'|max:255',
            'last_name'  => 'required|max:255',
            'phone'      => 'required|max:255',
            'email'      => Auth::guard('admin') ? 'required|email': 'required|email|unique:users,email'. $id,
            'photo'      => 'image|max:2048',
            'password'   => $password.$check,
            'password_confirmation'   => $password,
            // 'reg_enterprise' => 'required'
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
            'g-recaptcha-response.required' => __('Por favor verifica que no eres un robot.'),
            'first_name.required' => __('Se requiere el primer nombre.'),
            'last_name.required' => __('El campo Apellido es obligatorio.'),
            'country.required' => __('El país es obligatorio.'),
            'city.required' => __('Ciudad es requerida.'),
            'address.required' => __('La dirección es necesaria.'),
            'zip.required' => __('Se requiere código postal.'),
            'phone.required' => __('Se requiere número de teléfono.'),
            'email.required' => __('El campo de correo electrónico es obligatorio.'),
            'email.email'   => __('El correo electrónico debe ser una dirección de correo electrónico válida.'),
            'password.required'    => __('El campo de contraseña es obligatorio.')
        ];
    }
}
