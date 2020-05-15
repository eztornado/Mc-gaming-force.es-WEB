<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminEconomiaController extends Controller
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
                $eco = DB::select('SELECT veconomy.*, users.minecoins from veconomy'
                        . ' left join users on users.nick = veconomy.name');
                
                return view('admin/economy',["user" => $user,"eco" => $eco]);
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }
    }        
}
