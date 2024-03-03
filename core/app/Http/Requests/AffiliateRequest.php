<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AffiliateRequest extends FormRequest
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


        $id = $this->affiliate ? ',' . $this->affiliate->id : '';
        $required = $this->affiliate ? '' : 'required|';

        return [
            'name'            => 'required|max:255',
            'slug'            => 'required','unique:items,slug' . $id, 'regex:/^[a-zA-Z0-9-]+$/',
            'category_id'     => 'required',
            'details'         => 'required',
            'affiliate_link'  => 'required',
            'sort_details'    => 'required',
            'discount_price'  => 'required|max:50',
            'previous_price'  => 'max:50',
            'stock'           => 'numeric|max:9999999999',
            'photo'           => $required, 'mimes:jpeg,jpg,png,svg'
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
            'name.required'            =>  __('El campo de nombre es obligatorio.'),
            'affiliate_link.required'  =>  __('Se requiere enlace de afiliado.'),
            'category_id.required'     =>  __('El campo de categoría es obligatorio.'),
            'brand_id.required'        =>  __('El campo de marca es obligatorio.'),
            'slug.required'            =>  __('El campo Slug es obligatorio.'),
            'slug.unique'              =>  __('Esta babosa ya ha sido tomada.'),
            'details.required'         =>  __('El campo de descripción es obligatorio.'),
            'sort_details.required'    =>  __('El campo Descripción de clasificación es obligatorio.'),
            'discount_price.required'  =>  __('El campo Precio actual es obligatorio.'),
            'stock.required'           =>  __('El campo de Stock debe ser numérico mayor a 0.'),
            'photo.required'           =>  __('El campo de la imagen es obligatorio.'),
            'photo.mimes'              =>  __('El tipo de imagen debe ser jpg, jpeg, png, svg.')
        ];
    }

}
