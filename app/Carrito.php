<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carritos';
    
    protected $fillable = [
        'id',
        'uuid',
        'estado'
    ];
    //
}
