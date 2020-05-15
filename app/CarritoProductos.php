<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarritoProductos extends Model
{
    protected $table = 'carritos_productos';
    protected $fillable = [
        'carrito',
        'producto'
    ];
    //
}
