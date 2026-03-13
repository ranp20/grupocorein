<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Store extends Model{
    protected $table = 'tbl_stores';
    protected $fillable = ['name','address','telephone'];
    public $timestamps = false;
}
