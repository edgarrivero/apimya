<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = [
        'num_factura', 'pago', 'cliente_id'        
    ];
    
    public function cliente(){
        return $this->belongsTo('App\Cliente');
    }
}
