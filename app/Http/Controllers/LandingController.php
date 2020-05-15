<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\DB;
use App\EstadoRed;


class LandingController extends Controller
{
    public function index()
    {
        $user = null;
        if(Auth::id() != null && Auth::id() > 0)
        {
            $user = \App\User::find(Auth::id());
        }    
        
        try{
            if(env('APP_URL') == "https://mc.gaming-force.es")
            {
                $posts_foro = DB::connection('mysql2')->select("select * from xf_thread where node_id = 53 and discussion_state != 'deleted' order by thread_id desc limit 5;");
                    
                    foreach($posts_foro as $p)
                    {
                        $p->posts = DB::connection('mysql2')->select("select * from xf_post where thread_id = ".$p->thread_id . " ORDER BY post_id ASC limit 1");
                    }

            }
            else
            {
                $posts_foro = null;
            }
        } catch (Exception $ex) {

        }
        
        $estado_red_object =  EstadoRed::find(1);
        $estado_red = $estado_red_object->getEstado();

                
        
        return view('landing',['c' => 'home','user' => $user,'estado_red' => $estado_red,'posts' => $posts_foro]);
    }
    
    public function PanelServidores()
    {

        $user = null;
        if(Auth::id() != null && Auth::id() > 0)
        {
            $user = \App\User::find(Auth::id());
            
            $rango_usuario = $user->getRank();
            
            if($rango_usuario['grupo'] == "DEV")
            {
                return view('admin_panel',['c' => 'home','user' => $user]);
            }
            else
            {
                return "logueate coño, usa la web que he hecho!!";
            }
            
        }    
        
                
        
          
        
    }
    

    

}
