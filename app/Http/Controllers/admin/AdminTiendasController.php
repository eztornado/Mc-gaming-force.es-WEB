<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTiendasController extends Controller
{
    //
    public function index()
    {
        $user = $this->checkLogin();
        if($user != null)
        {
           /* $rank = $user->getRank();
            if($rank["grupo"] != "ADMIN" && $rank["grupo"] != "DEV")
            {
               return redirect(env('APP_URL').'/login'); 
            }
            else
            {
                $pedidos = DB::select('SELECT pedidos.*, users.nick usuario_nombre, productos_tienda.nombre producto_nombre from pedidos'
                        . ' left join productos_tienda on productos_tienda.id = pedidos.producto'
                        . ' left join users on users.id = pedidos.usuario'
                        . ' ORDER by pedidos.id DESC');
                
                return view('admin/pedidos',["user" => $user,"pedidos" => $pedidos]);
            }
*/
            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }
    }    
}
