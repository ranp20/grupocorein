<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Slider extends Model{
  protected $fillable = [
    'title', 
    'logo', 
    'photo',
    'link',
    'details',
    'home_page',
    'content_check',
    'content_info'
  ];
  public $timestamps = false;
}
