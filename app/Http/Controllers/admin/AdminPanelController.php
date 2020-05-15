<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPanelController extends Controller
{
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
                return view('admin/panel',["user" => $user]);
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }
    }
    //
}
