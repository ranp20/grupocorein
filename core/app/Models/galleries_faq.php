<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class galleries_faq extends Model
{
    protected $fillable = ['faq_id','photo'];
    public $timestamps = false;
}
