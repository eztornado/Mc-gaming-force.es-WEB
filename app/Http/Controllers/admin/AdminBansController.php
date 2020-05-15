<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminBansController extends Controller
{
    //
    public function index()
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
                $bans = DB::select('SELECT DKBans_histories.*, users.nick usuario_nombre, admins.nick admin_nombre from DKBans_histories '
                        . ' left join users on users.uuid =  DKBans_histories.uuid'
                        . ' left join users admins on admins.uuid =  DKBans_histories.staff'
                        .'');
                
                return view('admin/bans',["user" => $user,"bans" => $bans]);
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }
    }        
      
}
