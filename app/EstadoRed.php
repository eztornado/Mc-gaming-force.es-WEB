<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoRed extends Model
{
    protected $table = 'estado_red';
    protected $fillable = [
        'survival',
        'survival_players',
        'bungeecord',
        'bungeecord_players',
        'factions',
        'factions_players',
        'auth',
        'auth_players'
        ];
    //
    
    public function getEstado()
    {
                $estado_red = \App\EstadoRed::where('id',1)->first();
        
        if($estado_red->survival == 0)
        {
            $datos_inicio['survival'] = '<span class="right badge badge-danger">SURVIVAL</span>';
        }
        else
        {
            $datos_inicio['survival'] = '<span class="right badge badge-success">SURVIVAL</span>';
        }
        
        if($estado_red->bungeecord == 0)
        {
            $datos_inicio['bungeecord'] = '<span class="right badge badge-danger">BUNGEECORD</span>';
        }
        else
        {
            $datos_inicio['bungeecord'] = '<span class="right badge badge-success">BUNGEECORD</span>';
        }    
        
        if($estado_red->factions == 0)
        {
            $datos_inicio['factions'] = '<span class="right badge badge-danger">FACTIONS</span>';
        }
        else
        {
            $datos_inicio['factions'] = '<span class="right badge badge-success">FACTIONS</span>';
        }        
        
        if($estado_red->auth == 0)
        {
            $datos_inicio['auth'] = '<span class="right badge badge-danger">AUTH</span>';
        }
        else
        {
            $datos_inicio['auth'] = '<span class="right badge badge-success">AUTH</span>';
        }        
        
        return $datos_inicio;
    }
}
