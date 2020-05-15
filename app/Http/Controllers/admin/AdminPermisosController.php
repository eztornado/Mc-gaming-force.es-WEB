<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminPermisosController extends Controller
{
    //
    
    public function permisos_de_grupo()
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            $rank = $user->getRank();
            if($rank["grupo"] != "ADMIN" && $rank["grupo"] != "DEV")
            {
               return redirect(env('APP_URL').'/login'); 
            }
            else
            {
                $permisos = DB::select('SELECT * from luckperms_group_permissions');
                
                return view('admin/permisos',["user" => $user,"permisos" => $permisos]);
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }
    }    

    public function permisos_de_usuario()
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            $rank = $user->getRank();
            if($rank["grupo"] != "ADMIN" && $rank["grupo"] != "DEV")
            {
               return redirect(env('APP_URL').'/login'); 
            }
            else
            {
                $permisos = DB::select('SELECT luckperms_user_permissions.* , p.username usuario_nombre from luckperms_user_permissions'
                            . ' left join luckperms_players p on p.uuid = luckperms_user_permissions.uuid');
                
                return view('admin/permisos_usuario',["user" => $user,"permisos" => $permisos]);
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }
    }
    
    public function eliminar_permiso_usuario($id)
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            $rank = $user->getRank();
            if($rank["grupo"] != "ADMIN" && $rank["grupo"] != "DEV")
            {
               return redirect(env('APP_URL').'/login'); 
            }
            else
            {
                $p = DB::select('DELETE FROM luckperms_user_permissions where id =  '.$id);
                return redirect(env('APP_URL').'/admin/permisos_de_usuario');
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }        
        
    }
    
    public function eliminar_permiso_grupo($id)
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            $rank = $user->getRank();
            if($rank["grupo"] != "ADMIN" && $rank["grupo"] != "DEV")
            {
               return redirect(env('APP_URL').'/login'); 
            }
            else
            {
                $p = DB::select('DELETE FROM luckperms_group_permissions where id =  '.$id);
                return redirect(env('APP_URL').'/admin/permisos_de_grupo');
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }        
        
    }  
    
    public function actualizar_permiso_usuario($id,$grupo)
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            $rank = $user->getRank();
            if($rank["grupo"] != "ADMIN" && $rank["grupo"] != "DEV")
            {
               return redirect(env('APP_URL').'/login'); 
            }
            else
            {
                $lpu = \App\LuckPermsUsers::where('uuid',$id)->first();
                $usuario = \App\User::where('nick',$lpu->username)->first();
                
                $usuario->UpdateGroup($grupo);
                return redirect(env('APP_URL').'/admin/permisos_de_usuario');
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }        
        
    }    
    
    public function ver_anyadir_permiso_grupo()
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            $rank = $user->getRank();
            if($rank["grupo"] != "ADMIN" && $rank["grupo"] != "DEV")
            {
               return redirect(env('APP_URL').'/login'); 
            }
            else
            {
                return view('admin/anyadir_permisos_grupo',["user" => $user]);
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }        
        
    }      
    
    public function anyadir_permiso_grupo($grupo,$permiso,$value,$server,$world)
    {
        
        $user = $this->checkLogin();
        if($user != null)
        {
            $rank = $user->getRank();
            if($rank["grupo"] != "ADMIN" && $rank["grupo"] != "DEV")
            {
               return redirect(env('APP_URL').'/login'); 
            }
            else
            {
                $a = DB::select("INSERT INTO luckperms_group_permissions (name,permission,value,server,world,expiry,contexts) VALUES('".$grupo."','".$permiso."','".$value."','".$server."','".$world."',0,'{}')");
                return json_encode('ok');
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }        
                
        
    }
    
    public function anyadir_player($nombre,$grupo)
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            $rank = $user->getRank();
            if($rank["grupo"] != "ADMIN" && $rank["grupo"] != "DEV")
            {
               return redirect(env('APP_URL').'/login'); 
            }
            else
            {
                $player = \App\LuckPermsUsers::where('username',$nombre)->first();
                if(is_null($player))
                {
                    return response(json_encode('Usuario no Encontrado'),404);
                }
                
                $b = DB::select("UPDATE luckperms_players set primary_group = '".$grupo."' where username = '".$player->username."'  ");
                

                return redirect(env('APP_URL').'/admin/permisos_players');
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }         
        
    }
    

    public function permisos_grupos()
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            $rank = $user->getRank();
            if($rank["grupo"] != "ADMIN" && $rank["grupo"] != "DEV")
            {
               return redirect(env('APP_URL').'/login'); 
            }
            else
            {
                $grupos = DB::select('SELECT * from luckperms_groups');
                
                return view('admin/grupos',["user" => $user,"grupos" => $grupos]);
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }
    }     
    
    public function permisos_players()
    {
        $user = $this->checkLogin();
        if($user != null)
        {
            $rank = $user->getRank();
            if($rank["grupo"] != "ADMIN" && $rank["grupo"] != "DEV")
            {
               return redirect(env('APP_URL').'/login'); 
            }
            else
            {
                $players = DB::select('SELECT * from luckperms_players');
                
                return view('admin/permisos_players',["user" => $user,"players" => $players]);
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }
    }         
}
