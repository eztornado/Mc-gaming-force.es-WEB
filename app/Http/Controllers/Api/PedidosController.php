<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function index()
    {
        $user = $this->checkLogin();
        if($user != null)
        {    
            $select = 'SELECT pedidos.* , productos_tienda.nombre nombre from pedidos'
                    . ' left join productos_tienda on productos_tienda.id = pedidos.producto'
                    . " where pedidos.usuario = ".$user->id." "
                    . " and fecha_inicio <= CURDATE() and fecha_final >= CURDATE()";
            $pedidos = DB::select($select);
           
            
            return json_encode($pedidos);
            
        }     
        else
        {
             redirect(env('APP_URL').'/login');
        }          
    }
}
