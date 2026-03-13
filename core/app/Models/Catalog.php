<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Catalog extends Model{
  protected $table = 'tbl_catalogs';
  protected $fillable = ['name','photo','adj_doc','status'];
}