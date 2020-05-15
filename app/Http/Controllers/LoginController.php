<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $user = null;
        if(Auth::id() != null && Auth::id() > 0)
        {
            $user = \App\User::find(Auth::id());
        } 
        return view('login',['c'=> 'home','user' => $user]);
    }
    
    public function doLogin(Request $request)
    {
        $nickname = $request->input('nickname');
        $password = $request->input('password');
        $errors = array();
        
        $password_hash = md5($password);
        //echo $password_hash."\n";
        $user = \App\User::where('nick',$nickname)->where('password',$password_hash)->first();
        
        if(!is_null($user))
        {
            session('user_id', $user);
            Auth::login($user);
            

        }
        else
        {
            array_push($errors, "Usuario o contraseña incorrecto");
        }
        
        return json_encode(["status" => "ok", "errors" => $errors]);
                
        
        
    }
    
    public function logout() 
    {
        Auth::logout();
       return redirect(env('APP_URL'));
    }
    //
}
