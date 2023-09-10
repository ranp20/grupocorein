<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RootAttribute extends Model{
    protected $table = 'tbl_atributoraiz';
    protected $fillable = ['name'];
}
