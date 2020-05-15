<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    //
    protected $table = 'pedidos';
    
    protected $fillable = [
        'producto',
        'usuario',
        'fecha_inicio',
        'fecha_final'
    ];
}
