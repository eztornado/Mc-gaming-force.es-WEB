<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EliminarCuentas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'srv:eliminar_cuentas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina las cuentas que se han introducido en users y no han finalizado el registro';

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
        
        $users_a_eliminar = DB::select('DELETE FROM users where password is null');
        
        //
    }
}
