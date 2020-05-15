<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //
    
    public function index(Request $request)
    {
        
        $user = $this->checkLogin();
        if($user != null)
        {

            $resultado = json_encode(null);
            $tam = $request->input('tam');
            if(isset($tam) && $tam != null && $tam==1)
            {
                $users = \App\User::all();
                return json_encode(sizeof($users));


            }
            else
            {
                // DATOS ADMIN USUARIOS
                //SIN IMPLEMENTAR
            }
        }
         else 
         {
             redirect(env('APP_URL').'/login');
         }
        
    }
    
    
    
    
    public function getUsuariosOnline()
    {
        $usuarios = DB::select(' SELECT nombre,servidor FROM jugadores_online where online = 1');

        return json_encode($usuarios);
        
    }
    
    public function SetEnServicio($valor)
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            $user->SetAdminEnServicio($valor);
        }        
        return json_encode("ok");
        
    }
    
    public  function GetEnServicio()
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            return json_encode($user->GetAdminEnServicio());
        }       
        else
        {
            return json_encode(false);
        }
        
    }


    public function EsAdmin()
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            return json_encode($user->IsAdmin());
        }
        else 
       {
            return json_encode(false);
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
    
    


    
    public function show($id)
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            $user_rank = $user->getRank();
            if($user_rank['grupo'] == 'DEV' || $user_rank['grupo'] == 'ADMIN')
            {
                    //Puede ver cualquier usuario, avanzamos
            }
            else
            {
                //Solo puede verse a si mismo
                if($id != $user->id)
                {
                    //ERROR
                    return json_encode('No tienes permisos para ver a este usuario');
                    
                }
                else
                {
                    //OK, AVANZAMOS
                    
                }
            }
            

                $usuario = \App\User::where('id',$id)->get()->map(function ($elemento)
                {
                    $usuario_object = \App\User::find($elemento['id']);
                    $elemento['rank'] = $usuario_object->getRank();
                    $elemento['balance'] = $usuario_object->getEconomy();
                    $elemento['playtime'] = $usuario_object->getPlayTime();
                    $elemento['online'] = $usuario_object->isOnline();
                    $elemento['bans'] = $usuario_object->getBans();
                    $elemento['verified_on_discord'] = $usuario_object->getRegisteredOnDiscord();
                    return $elemento;
                }
                );
                
                
                return json_encode($usuario[0]);            
            
        }
        else
        {
          redirect(env('APP_URL').'/login');  
        }
        
    }
}
