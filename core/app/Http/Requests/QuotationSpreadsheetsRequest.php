<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class QuotationSpreadsheetsRequest extends FormRequest{
  public function authorize(){
    return true;
  }

  public function rules(){
    $id = $this->quotationspreadsheet ? ',' . $this->quotationspreadsheet->id : '';
    $required = $this->quotationspreadsheet ? '' : 'required';

    return [
      'spreadsheet'      => 'required'
    ];
  }

  public function messages(){
    return [
      'spreadsheet.required' => __('El campo de hoja de excel es obligatorio.')
    ];
  }
}
