<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Departamento extends Model{
  protected $table = 'tbl_departamentos';
  protected $fillable = [
    'departamento_code',
    'departamento_name'
  ];
  public $timestamps = false;
}