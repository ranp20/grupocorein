<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingService extends Model
{
    protected $fillable = [
        'title',
        'departamento_id',
        'provincia_id',
        'distrito_id',
        'price',
        'status',
        'is_condition',
        'minimum_price'
    ];
    public $timestamps = false;
    
    public function departamento()
    {
        return $this->belongsTo('App\Models\Departamento')->withDefault();
    }
    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia')->withDefault();
    }
    public function distrito()
    {
        return $this->belongsTo('App\Models\Distrito')->withDefault();
    }

}
