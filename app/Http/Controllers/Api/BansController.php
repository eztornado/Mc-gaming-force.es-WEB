<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BansController extends Controller
{
    function index($pag)   
    {
        $offset = ($pag-1) * 20 ;
        
        $bans = DB::select("select * from DKBans_histories order by id desc limit 20 offset ".$offset );
        return json_encode($bans);
        
        
        
        
    }
    //
}
