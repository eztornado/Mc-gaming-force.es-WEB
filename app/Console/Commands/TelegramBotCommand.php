<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;
use Illuminate\Support\Facades\DB;
use App\User;


class TelegramBotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegrambot:run';

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
        //
        $telegram = new Api(env('TELEGRAM_TOKEN'));
        $update = $telegram->commandsHandler(false, ['timeout' => 30]);
        
        $usuario_telegram = "";
        $isbot = 0;
        $first_name = "";
        $comando = "";
        
        print_r($update);   
        
        foreach($update as $u)
        {
            foreach($u as $mensaje)
            {
                $mensaje_id = $mensaje['message_id'];
                $usuario_telegram = $mensaje['chat']['id'];
               // $isbot = $from['is_bot'];
               // $first_name = $from['first_name'];
                $comando = $mensaje['text'];
            }
            
        }    
        
        $id_grupo = -377733215;
        
        //Comprobar usuarios registrados
        $usuarios_registrados = DB::select('select  TIMESTAMPDIFF(SECOND,created_at, CURRENT_TIMESTAMP())tiempo,nick from users HAVING tiempo <= 300');
        $usuarios_total = User::all();
        foreach($usuarios_registrados as $ur)
        {
                $telegram->sendMessage([
               'chat_id' => $id_grupo,
               'parse_mode' => "HTML",
               'text' => "Tenemos un nuevo usuario registrado : ".$ur->nick. " y ya van  ".sizeof($usuarios_total). " usuarios registrados"
           ]); 
        }
        
        
        
        
        
        
        
        
        
        
        
    }
}
