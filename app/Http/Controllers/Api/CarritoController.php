<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    
    public function anañadirProducto($producto)
    {
        $user = $this->checkLogin();
        if($user != null)
        {    
            $carrito = \App\Carrito::where('uuid',$user->uuid)->first();
            if(!is_null($carrito))
            {
                \App\CarritoProductos::create([
                    'carrito' => $carrito->id,
                    'producto' => $producto
                ]);
                
            }
            else
            {
                $carrito = \App\Carrito::create([
                    'uuid' => $user->uuid
                ]);
                
                \App\CarritoProductos::create([
                    'carrito' => $carrito->id,
                    'producto' => $producto
                ]);                
            }
            
            return json_encode('ok');
            
        }     
        else
        {
             redirect(env('APP_URL').'/login');
        }        
        
    }
    
    public function delete($id)
    {
        $user = $this->checkLogin();
        if($user != null)
        {        
            $carrito = \App\Carrito::where('id',$id)->first();
            
            if($carrito->uuid == $user->uuid)
            {


                    DB::select('DELETE FROM carritos_productos where carrito = '.$carrito->id);
                    

                
                return json_encode("ok");
                
            }
            else
            {
                return json_encode('No tienes permisos para eliminar este carrito');
            }
            
            
        }
        else
        {
             redirect(env('APP_URL').'/login');
        }
    }
    
    public function comprar()
    {
        $user = $this->checkLogin();
        if($user != null)
        {   
            $total = 0;
            $carrito = \App\Carrito::where('uuid',$user->uuid)->first();
            
            if(is_null($carrito))
            {
                return json_encode(["mensaje" => "Tienes 0 Productos seleccionados"]);
            }else
            {
                $productos = \App\CarritoProductos::where('carrito',$carrito->id)->get();
                $total = 0;
                foreach($productos as $p)
                {

                    $producto = \App\Producto::where('id',$p['producto'])->first();
                    $total += $producto->precio;
                }
                
                if($total > 0)
                {
                    if($user->minecoins >= $total)
                    {
                        
                       
                        
                        
                        

                        
                        $mensaje = "";
                        
                        foreach($productos as $p)
                        {

                            $producto = \App\Producto::where('id',$p['producto'])->first();
                            
                                $pedidos = DB::select('SELECT pedidos.* , productos_tienda.nombre nombre from pedidos'
                                . ' left join productos_tienda on productos_tienda.id = pedidos.producto'
                                . ' where pedidos.usuario = '.$user->id." "
                                . " and fecha_inicio <= CURDATE() and fecha_final >= CURDATE()"
                                . " and pedidos.producto =".$producto->id);                            
                            
                                if(sizeof($pedidos) >0)
                                {
                                    $mensaje.= "El producto ".$producto->nombre." YA ESTÁ ACTIVO en tu cuenta, no se han realizado cambios \n";
                                }
                                else
                                {
                            
                                    $user->minecoins = $user->minecoins - $total;
                                    $user->save();
                                    
                                    $colaDato = \App\ColaTienda::create([
                                        'user' => $user->id,
                                        'accion' => $producto->accion,
                                        'dato' => $producto->dato,
                                        'producto' => $producto->id,

                                    ]);
                                    
                                    $mensaje.= "El producto ".$producto->nombre." ha sido comprado correctamente \n";
                                }

                            
                        }           
                        
                        $this->delete($carrito->id);
                        
                        return json_encode(["mensaje" => $mensaje]);

                        
                        
                        
                    }
                    else
                    {
                        return json_encode(["mensaje" => "No tienes suficientes MineCoins"]);
                    }


                }
                else 
                {
                    return json_encode(["mensaje" => "Tienes 0 Productos seleccionados"]);
                }
            }
            
        }   
        else
        {
            redirect(env('APP_URL').'/login');
        }
        
    }
    
    //
}
