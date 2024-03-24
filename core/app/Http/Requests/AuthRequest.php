<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class AuthRequest extends FormRequest{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'login_email'=> 'required|email',
            'login_password'   => 'required'
        ];
    }
    public function messages(){
        return [
            'login_email.required' => __('El campo de correo electrónico es obligatorio.'),
            'login_email.email'   => __('El correo electrónico debe ser una dirección de correo electrónico válida.'),
            'login_password.required'    => __('El campo de contraseña es obligatorio.')
        ];
    }
}