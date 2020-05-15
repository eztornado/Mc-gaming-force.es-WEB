<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BansController extends Controller
{
    //

    public function index($pag = 1)
    {
        $user = null;
        if(Auth::id() != null && Auth::id() > 0)
        {
            $user = \App\User::find(Auth::id());
        }
        
                $bans = DB::select('SELECT DKBans_histories.*, users.nick usuario_nombre, admins.nick admin_nombre from DKBans_histories '
                        . ' left join users on users.uuid =  DKBans_histories.uuid'
                        . ' left join users admins on admins.uuid =  DKBans_histories.staff'
                        .'');        


        

        return view('bans',['c' => 'home','pag' => $pag,'bans' => $bans,'user' => $user]);
    }
    

    

}
