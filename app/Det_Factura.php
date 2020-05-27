<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Det_Factura extends Model
{
    protected $fillable = [
        'pago', 'factura_id', 'producto_id'
    ];

    public function facturas(){
        return $this->hasMany('App\Facturas');
    }
    public function productos(){
        return $this->hasMany('App\Productos');
    }
}
