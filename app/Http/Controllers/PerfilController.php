<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    //
    public function index()
    {
        $user = $this->checkLogin();
        if($user != null)
        {

            
        }
        else
        {
            redirect(env('APP_URL').'/login');
        }

        return view('perfil',['c' => 'home','user' => $user]);    
    }    
    
    public function historicoProductosPedidos()
    {
        $user = $this->checkLogin();
        if($user != null)
        {

            
        }
        else
        {
            redirect(env('APP_URL').'/login');
        }
        
        $historico = DB::select("SELECT cola_tienda.*,productos_tienda.nombre nombre from cola_tienda "
                . " left join productos_tienda on productos_tienda.id = cola_tienda.producto"
                . " where user =  ".$user->id
                . " order by id DESC");

        return view('historico_productos_pedidos',['c' => 'home','historico' => $historico,'user' => $user]);         
        
    }
    
    public function cambiarContrasenya()
    {
        $user = $this->checkLogin();
        if($user != null)
        {

            return view('cambiar_contrasenya',['c' => 'home','user' => $user]);
        }
        else
        {
            redirect(env('APP_URL').'/login');
        }        
        
        
    }
    
    public function actualizarContrasenya($nueva)
    {
        $user = $this->checkLogin();
        if($user != null)
        {

            $user->password =  md5($nueva);
            $user->save();
            return json_encode("ok");
        }
        else
        {
            return json_encode("error");
        }           
        
        
        
        
    }
}
