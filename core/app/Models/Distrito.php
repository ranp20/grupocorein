<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Distrito extends Model{
  protected $table = 'tbl_distritos';
  protected $fillable = [
    'departamento_code',
    'provincia_code',
    'distrito_code',
    'distrito_name'
  ];
  public $timestamps = false;
}