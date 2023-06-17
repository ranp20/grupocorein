<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationSpreadsheets extends Model
{
    protected $table = 'tbl_quotation_spreadsheets';
    protected $fillable = ['spreadsheet'];
    public $timestamps = false;
}
