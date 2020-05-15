<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
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
        

        
        
        return view('notificaciones',['c' => 'home','user' => $user]);        
    }
}
