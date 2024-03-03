<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Coupons extends Model{
    protected $table = 'tbl_coupons';
    protected $fillable = [
        'name',
        'discount_percentage',
        'photo',
        'date_init',
        'date_end',
        'time_end',
        'status'
    ];
    public $timestamps = false;
}
