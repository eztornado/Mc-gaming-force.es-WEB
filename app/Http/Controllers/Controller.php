<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    protected function checkLogin()
    {
        $user = null;
        if(Auth::id() != null && Auth::id() > 0)
        {
            return $user = \App\User::find(Auth::id());
        }  
        else
        {
            return null;
        }
    }
    
}
