<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\WebSenderAPI;

class CheckServers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed    
     */
    public function handle()
    {
        $status_bungeecord = new WebsenderAPI("mc.gaming-force.es",env('RCON_PASSWORD'),"9876"); // HOST , PASSWORD , PORT
        $status_survival = new WebsenderAPI("mc.gaming-force.es",env('RCON_PASSWORD'),"9877"); // HOST , PASSWORD , PORT
        $status_factions = new WebsenderAPI("mc.gaming-force.es",env('RCON_PASSWORD'),"9878"); // HOST , PASSWORD , PORT
        $status_auth = new WebsenderAPI("agustinos.tv",env('RCON_PASSWORD'),"9876"); // HOST , PASSWORD , PORT
        
        $survival_online = 0;
        $bungeecord_online = 0;
        $factions_online = 0;
        $auth_online = 0;
        
        if($status_bungeecord->connect()) { $bungeecord_online = 1; }
        if($status_survival->connect()) { $survival_online = 1; }
        if($status_factions->connect()) { $factions_online = 1; }
        if($status_auth->connect()) { $auth_online = 1; }
        
        $estado_red = \App\EstadoRed::find(1);
        $estado_red->bungeecord = $bungeecord_online;
        $estado_red->survival = $survival_online;
        $estado_red->factions = $factions_online;
        $estado_red->auth = $auth_online;
        $estado_red->save();

        $status_bungeecord->disconnect();  
        $status_survival->disconnect();  
        $status_factions->disconnect();  
        $status_auth->disconnect();  
    }
}
