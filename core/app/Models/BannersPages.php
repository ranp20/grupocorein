<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannersPages extends Model
{
    protected $fillable = ['name', 'section','photo', 'status'];
    public $timestamps = false;
}
