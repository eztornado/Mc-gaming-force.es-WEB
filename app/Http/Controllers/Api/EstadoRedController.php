<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EstadoRed;

class EstadoRedController extends Controller
{
    
    public function getNetworkStatus()
    {
        $estado = EstadoRed::where('id',1)->get()->first();
        return json_encode($estado);    
    }
    //    
    //
}
