<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\UsersPermissions;
use App\LuckPermsUsers;
use App\WebSenderAPI;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'nick',
        'premium',
        'firstIP',
        'lastIP',
        'firstJoined',
        'lastJoined',
        'checked',
        'online',
        'registeredByAdmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    public function IsAdmin()
    {
        $user_permisos = DB::select("select * from luckperms_players where username =  '".$this->nick."' limit 1");
        foreach($user_permisos as $up)
        {
            return $up->primary_group == "root" || $up->primary_group == "admin" || $up->primary_group == "mod"  ;
        }
    }
    
    public function GetAdminEnServicio()
    {
        $resultado = false;
        if($this->IsAdmin() )
        {
            $rank = $this->getRank();
            if($rank['grupo'] == "DEV" || $rank['grupo'] == "ADMIN" || $rank['grupo'] == "MOD" ) 
            {
                $resultado = true;
            }
        }
        return $resultado;
    }
    
    public function SetAdminEnServicio($valor = false)
    {
        

            if($this->IsAdmin())
            {
                if($valor == true)
                {
                    if($this->GetAdminEnServicio() == false)
                    {
                        $grupo = "";
                        $user_permisos = DB::select("select * from luckperms_players where username =  '".$this->nick."' limit 1");
                        foreach($user_permisos as $up)
                        {
                            $grupo = $up->primary_group;
                        }                        
                        $this->UpdateGroup($grupo);
                        
                       /*$status_bungeecord = new WebsenderAPI("mc.gaming-force.es",env('RCON_PASSWORD'),"9876"); // HOST , PASSWORD , PORT

                        if($status_bungeecord->connect()) { 
                            $status_bungeecord->sendMessage("Hay un nuevo Administrador en servicio : ".$this->nick." ");
                            }
                        $status_bungeecord->disconnect();*/                         
                    }
                }
                else 
                {
                    if($this->GetAdminEnServicio() == true)
                    {
                        $this->UpdateGroup('user');
                       /* $status_bungeecord = new WebsenderAPI("mc.gaming-force.es",env('RCON_PASSWORD'),"9876"); // HOST , PASSWORD , PORT

                        if($status_bungeecord->connect()) { 
                            $status_bungeecord->sendMessage("El Administrador : ".$this->nick." ya no está de servicio ");
                            }
                        $status_bungeecord->disconnect(); */                       
                    }
                }
            }

        
        
    }
    
    public function getEconomy()
    {
        $total = DB::select("select balance from veconomy,luckperms_players where ".
                "luckperms_players.username = '".$this->nick."' and "
                ." luckperms_players.uuid = veconomy.uuid");
        $resultado = 0;
        foreach($total as $t)
        {
            $resultado = $t->balance;
        }
        
        return $resultado;
    }
    
    public function isOnline()
    {
        $total = DB::select("select online,servidor from jugadores_online where nombre = '".$this->nick."' limit 1");
        
        if(!is_null($total)) return $total[0];
        else return null;
        
        
    }
    
    public function getRank()
    {
        
        $permiso = DB::select("SELECT permission FROM luckperms_user_permissions,luckperms_players
                WHERE permission LIKE('%group%')
                AND luckperms_user_permissions.UUID = luckperms_players.UUID 
                AND luckperms_players.username = '".$this->nick."'
                AND permission != 'group.default'");
        
        $permission = "";
        foreach($permiso as $p)
        {
            $permission = $p->permission;
        }       
        
        $resultado = array();
        $grupo = "Sin Grupo";
        $color = "black";
        if($permission == "group.root") 
        {
            $grupo = "DEV";
            $color = "#a20d98";
        }
        
        if($permission == "group.user") 
        {
            $grupo = "USER";
            $color = "#17a2b8";
        } 
        
        if($permission == "group.vip") 
        {
            $grupo = "VIP";
            $color = "#f2ba0f";
        }  
        
        if($permission == "group.mod") 
        {
            $grupo = "MOD";
            $color = "#80FF00";
        } 
        
        if($permission == "group.admin") 
        {
            $grupo = "ADMIN";
            $color = "#FA5858";
        }      
        
        if($permission == "group.maper") 
        {
            $grupo = "MOD";
            $color = "#5858FA";
        }              

        $resultado['grupo'] = $grupo;
        $resultado['color'] =$color;
        return $resultado;        
        
        
    }
    
    public function UpdateGroup($nombre_grupo)
    {
        
        $nombre_grupo = strtolower($nombre_grupo);
        //Validar Grupo
        $grupo = Group::where('name',$nombre_grupo)->first();
        
        if(!is_null($grupo))
        {


        //Eliminar Grupo Anterior
        $usuario_luckperms = LuckPermsUsers::where('username',$this->nick)->first();
        $permisos_grupo = DB::select("select id from luckperms_user_permissions where uuid = '".$usuario_luckperms->uuid."' and permission LIKE('%group%')");
        foreach($permisos_grupo as $pg)
        {
            DB::select('DELETE FROM luckperms_user_permissions where id = '.$pg->id);
        }
        
        //Insertar Nuevo Grupo
        
        UsersPermissions::create([
            'uuid' => $usuario_luckperms->uuid,
            'permission' => 'group.'.$nombre_grupo,
            'value' => 1,
            'world' => "global",
            'server' => "global",
            'expiry' => 0,
            'contexts' => "{}"
        ]);
                

        }
        else
        {
            //Grupo No Encontrado
            
        }
            
        
    }
    
    
          
    
    
    /*public function getPermissionRank($user,$onlytext = false)
    {
        $permiso = DB::select("SELECT permission FROM luckperms_user_permissions,luckperms_players
                WHERE permission LIKE('%group%')
                AND luckperms_user_permissions.UUID = luckperms_players.UUID 
                AND luckperms_players.username = '".$user->nick."'
                AND permission != 'group.default'");
        
        $permission = "";
        foreach($permiso as $p)
        {
            $permission = $p->permission;
        }
        
        if($onlytext == false)
        {
        if($permission == "group.root")
        {
            return "<span style=\"!important; font-family: 'Press Start 2P';color:white\">[</span><p style=\"color: #a20d98  !important; font-family: 'Press Start 2P';\">Dev</p><span style=\"!important; font-family: 'Press Start 2P';color:white\">]</span>";
        }
        else
        {
            return "<span style=\"!important; font-family: 'Press Start 2P';color:white\">[</span>p style=\"color: white !important; font-family: 'Press Start 2P';  \">Sin Grupo</p><span style=\"!important; font-family: 'Press Start 2P';color:white\">]</span>";
        }
        }
        
        if($onlytext == true)
        {
            $resultado = array();
            $grupo = "Sin Grupo";
            $color = "black";
            if($permission == "group.root") 
            {
                $grupo = "DEV";
                $color = "#a20d98";
            }
            
            $resultado['grupo'] = $grupo;
            $resultado['color'] =$color;
            return $resultado;
        }
        
    }*/
    
    /*public function getEconomyBalance($user)
    {
        $total = DB::select('select balance from veconomy,luckperms_players where '.
                "luckperms_players.username = '".$user."' and "
                ." luckperms_players.uuid = veconomy.uuid");
        
        $resultado = 0;
        foreach($total as $t)
        {
            $resultado = $t->balance;
        }
        
        return $resultado;
    }*/
    
    public function getPlayTime()
    {
        $user = LuckPermsUsers::where('username',$this->nick)->first();
        $consulta = DB::select("SELECT SUM(survival_time + creative_time + adventure_time + spectator_time) total from plan_world_times where uuid = '".$user->uuid."'");
        
        $total = "";
        foreach($consulta as $c)
        {

            $total = $c->total;
        }
        //echo strlen($total);
        $total[strlen($total) - 1] = ' ';
        $total[strlen($total) - 2] = ' ';
        $total[strlen($total) - 3] = ' ';
        return $total;

    }
    
    public function getRegisteredOnDiscord()
    {
        $user = LuckPermsUsers::where('username',$this->nick)->first();
        $consulta = DB::select("SELECT * FROM discordsrv_accounts where uuid = '".$user->uuid."'");
        $resultado = false;
        if(sizeof($consulta) > 0)
        {
            $resultado = true;
        }
        return $resultado;
    }
    
    public function getInventory($user)
    {
        $inventarios = DB::select('select inventories.* from inventories,luckperms_players where '.
                "luckperms_players.username = '".$user."' and "
                ." luckperms_players.uuid = inventories.uuid");  
        
        return $inventarios;
        
    }
    
    public function getBans()
    {
        $query = DB::select ("SELECT h.reason, count(h.id) contador FROM DKBans_histories h,DKBans_players p ".
                "WHERE p.uuid = h.uuid AND p.name =  '".$this->nick."' GROUP BY h.reason");
        
        return $query;
    }
        
}
