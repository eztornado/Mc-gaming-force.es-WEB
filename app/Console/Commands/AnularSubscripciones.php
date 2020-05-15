<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;

class AnularSubscripciones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tienda:anular_subscripciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Desactiva un pedido en vigor  si caduca en la fecha actual';

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
        
        $hoy = date("Y-m-d"); 
        $pedidos = \App\Pedidos::where('fecha_final',$hoy)->get();
        
        foreach($pedidos as $p)
        {
            $usuario = \App\User::find($p['usuario']);
            $usuario->UpdateGroup("user");
            $id_grupo = -377733215;
            $telegram = new Api(env('TELEGRAM_TOKEN'));            
            $telegram->sendMessage([
           'chat_id' => $id_grupo,
           'parse_mode' => "HTML",
           'text' => "El usuario ".$usuario->nick." ha perdido su rango priviliegado, su actual grupo es : usuario"
            ]);    

            $producto = \App\Producto::find($p['producto']);

            $notificacion_usuario = \App\Notificaciones::create([
                'user' => $p['usuario'],
                'type' => 'danger',
                'fixed' => 0,
                'texto' => "Tu subscripción del grupo : ".$producto->nombre. " ha caducado. Deberás volver a adquirirlo para mantener tu rango. Has sido cambiado de grupo a Usuario"
            ]);
        }
        
        //
    }
}
