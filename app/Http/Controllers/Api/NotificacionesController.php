<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificacionesController extends Controller
{
    //
    
    public function index()
    {
        //Obtiene las notificaciones de un usuario
        $user = $this->checkLogin();
        if($user != null)
        {   
            $notificaciones = \App\Notificaciones::where('user',$user->id)->where('visto',0)->orderBy('fixed','DESC')->get();
            return json_encode($notificaciones);
            
        }
        else
        {
            redirect(env('APP_URL').'/login');
        }
    }
    
    public function visto($id)
    {
        //Obtiene las notificaciones de un usuario
        $user = $this->checkLogin();
        if($user != null)
        {   
            $notificacion = \App\Notificaciones::where('id',$id)->where('user',$user->id)->first();
            $notificacion->visto = 1;
            $notificacion->save();
            
        }
        else
        {
            redirect(env('APP_URL').'/login');
        }        
        
    }
}
