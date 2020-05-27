<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'cedula', 'nombre', 'tlf', 'tlf2','tlf_pago_movil', 'correo', 'pass_correo'
    ];

    public function cuentas(){
        return $this->hasMany('App\Cuenta');
    }

    public function facturas(){
        return $this->hasMany('App\Factura');
    }
}
