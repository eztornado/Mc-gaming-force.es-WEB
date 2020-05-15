<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixUsuariosOnline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'usuarios_online:fix';

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
        $usuarios = DB::select('SELECT id, TIMESTAMPDIFF(SECOND,updated_at, CURRENT_TIMESTAMP())tiempo  FROM jugadores_online
            WHERE TIMESTAMPDIFF(SECOND,updated_at, CURRENT_TIMESTAMP())
            HAVING tiempo > 300');

        foreach($usuarios as $u)
        {   
            DB::select('UPDATE jugadores_online set online = 0 where id = '.$u->id);
        }        
        //
    }
}
