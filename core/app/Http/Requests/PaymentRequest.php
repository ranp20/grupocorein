<?php
namespace App\Http\Requests;
use App\Models\State;
use Illuminate\Foundation\Http\FormRequest;
class PaymentRequest extends FormRequest{
  public function authorize(){
    return  true;
  }
  public function rules(){
    $data = $this->payment_method == 'Stripe' ? 'required' : '';
    $state = State::whereStatus(1)->count() > 0 ? 'required' : '';
    return [
      'state_id' => auth()->check() && auth()->user()->state_id ? '' : $state,
      'card'  => $data,
      'cvc'   => $data,
      'month' => $data,
      'year'  => $data
    ];
  }
  public function messages(){
    return [
      'state_id.required'   => __('Seleccione su estado de envío.'),
      'card.required'   =>  __('El campo de la tarjeta es obligatorio.'),
      'cvc.required'    =>  __('El campo CVC es obligatorio.'),
      'month.required'  =>  __('El campo de mes es obligatorio.'),
      'year.required'   =>  __('El campo de año es obligatorio.')
    ];
  }
}