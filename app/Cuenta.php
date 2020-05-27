<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $fillable = [
        'num_cuenta', 'num_tarjeta', 'banco', 'tipo_cuenta',
        'num_seguridad', 'fecha_vencimiento', 'user_internet',
        'pass_internet', 'clave_especial', 'clave_telefonica',
        'num_cheque', 'clave_cajero', 'pregunta_seguridad',
        'respuesta_seguridad','cliente_id'
    ];

    public function cliente(){
        return $this->belongsTo('App\Cliente');
    }
}
