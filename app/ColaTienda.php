<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColaTienda extends Model
{
    //
    protected $table = "cola_tienda";
    protected $fillable = [
        'user',
        'accion',
        'dato',
        'estado',
        'producto'
    ];
}
