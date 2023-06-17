<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Provincia extends Model{
  protected $table = 'tbl_provincias';
  protected $fillable = [
    'departamento_code',
    'provincia_code',
    'provincia_name'
  ];
  public $timestamps = false;
}