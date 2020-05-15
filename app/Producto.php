<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table = 'productos_tienda';
    protected $fillable = [
        'nombre',
        'precio',
        'descripcion',
        'imagen',
        'accion',
        'dato',
    ];
}
