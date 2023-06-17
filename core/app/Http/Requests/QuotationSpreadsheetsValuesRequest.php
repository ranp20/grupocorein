<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class QuotationSpreadsheetsValuesRequest extends FormRequest{
  public function authorize(){
    return true;
  }

  public function rules(){
    $id = $this->quotationspreadsheetvalues ? ',' . $this->quotationspreadsheetvalues->id : '';
    $required = $this->quotationspreadsheetvalues ? '' : 'required';

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
