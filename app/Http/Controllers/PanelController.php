<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Websender;
use App\EstadoRed;


class PanelController extends Controller
{
    public function index()
    {
        $user = $this->checkLogin();
        if($user != null)
        {
        
            $usuarios = \App\User::all();

            
            



        }


        
        
        return view('panel',['c' => 'home','user' => $user]);        
    }
    //
}
