<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TiendaController extends Controller
{
    
    public function index($id = null)
    {
        $user = $this->checkLogin();
        $datos = array();
        if($user != null)
        {
        
            $usuarios = \App\User::all();

            
            
            $datos['productos'] = \App\Producto::all();
            $datos['carrito'] = \App\Carrito::where('uuid',$user->uuid)->get()->first();
            if(!is_null($datos['carrito']))
            {
                $datos['productos_carrito'] = \App\CarritoProductos::where('carrito',$datos['carrito']['id'])->get()->map(function ($p){
                    
                    $p['producto'] = \App\Producto::where('id',$p['producto'])->get()->first();
                    return $p;
                });
            }
            else
            {
                $datos['productos_carrito'] = null;
            }

            



        }
        else
        {
           return redirect(env('APP_URL').'/login');
        }
        

        
        
       return view('tienda',['c' => 'home','user' => $user,'datos' => $datos]);         
    }
    
    public function añadir_carrito($producto)
    {
        
    }
    

    //
}

