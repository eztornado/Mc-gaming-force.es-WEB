<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUsersController extends Controller
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
                $users = \App\User::all();
                return view('admin/users',["user" => $user,"users" => $users]);
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }
    }    
    
    public function perfil($id)
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
                $user_perfil = \App\User::where('id',$id)->first();
                return view('admin/users_perfil',["user" => $user,"user_perfil" => $user_perfil]);
            }

            
        }
        else
        {
            return redirect(env('APP_URL').'/login');
        }        
        
    }
}
