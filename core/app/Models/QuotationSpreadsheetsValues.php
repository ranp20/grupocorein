<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class QuotationSpreadsheetsValues extends Model
{
    protected $table = 'tbl_quotation_spreadsheets_values';
    protected $fillable = [
        'distrito_code',
        'distrito_nombre',
        'provincia_code',
        'provincia_nombre',
        'departamento_code',
        'departamento_nombre',
        'min_amount',
        'max_amount',
    ];
    public $timestamps = false;
}
