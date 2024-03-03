<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sitemap extends Model
{
    protected $fillable = [
        'sitemap_lat',
        'sitemap_lng',
        'sitemap_name',
        'sitemap_status',
        'sitemap_url',
        'filename'
    ];
    public $timestamps = false;
}
