<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ComplaintsBook extends Model{
  protected $table = 'tbl_complaints_books';
  protected $fillable = [
    'cmptbk_codegen',
    'cmptbk_name',
    'cmptbk_departamento_id',
    'cmptbk_provincia_id',
    'cmptbk_distrito_id',
    'cmptbk_domicilio',
    'cmptbk_dni_ce',
    'cmptbk_ruc',
    'cmptbk_razonsocial',
    'cmptbk_telefono',
    'cmptbk_email',
    'cmptbk_typeofclaim',
    'cmptbk_detail',
    'cmptbk_order',
    'cmptbk_agecheck',
    'cmptbk_datayounger',
    'cmptbk_typeofgod',
    'cmptbk_reclaimedamount',
    'cmptbk_description',
  ];
  public $timestamps = true;
}