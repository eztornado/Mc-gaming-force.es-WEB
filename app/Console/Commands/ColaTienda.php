<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;
use Illuminate\Support\Facades\DB;

class ColaTienda extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tienda:procesar_cola';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se encarga de activar los productos que son comprados en la tienda';

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
    
    private function ProcesarLineaPedido(\App\ColaTienda $lineapedido)
    {
        if($lineapedido->user != null && $lineapedido->accion != null && $lineapedido->dato != null)
        {
            if($lineapedido->accion == "establecer_grupo")
            {
                $usuario = \App\User::find($lineapedido->user);
                $usuario->UpdateGroup($lineapedido->dato);
                
                $id_grupo = -377733215;
                    $telegram = new Api(env('TELEGRAM_TOKEN'));
                    $telegram->sendMessage([
                   'chat_id' => $id_grupo,
                   'parse_mode' => "HTML",
                   'text' => "El usuario ".$usuario->nick." ha sido movido a un nuevo grupo : ".$lineapedido->dato
               ]);                  
            }
        }
        
    }
    
    public function handle()
    {
        //
        $prodcutos_en_cola = \App\ColaTienda::where('estado','ESPERA')->get();
        
        echo "Econtrados ".sizeof($prodcutos_en_cola)." productos en cola \n";
        foreach($prodcutos_en_cola as $pec)
        {
            $prod = \App\ColaTienda::find($pec['id']);
            $this->ProcesarLineaPedido($prod);
            

            $fecha_inicio_select = DB::select('SELECT CURDATE() fecha');
            $fecha_inicio = "";
            foreach($fecha_inicio_select as $fi)
            {
                $fecha_inicio = $fi->fecha;
            }
            
            $fecha_fin_select = DB::select('SELECT DATE_ADD(CURDATE(), INTERVAL 1 MONTH) fecha');
            $fecha_fin = "";
            foreach($fecha_fin_select as $ff)
            {
                $fecha_fin = $ff->fecha;
            }            
            
            
            //Activar subscripcion, (que hemos llamado pedidoa para liar más xd)
            \App\Pedidos::create([
                'producto' => $prod['producto'],
                'usuario' => $prod['user'],
                'fecha_inicio' => $fecha_inicio,
                'fecha_final' => $fecha_fin
            ]);
            
            $prod->estado = 'FINALIZADO';
            $prod->save();
            
            $producto = \App\Producto::where('id',$prod['producto'])->first();
            \App\Notificaciones::create([
                'user' => $prod['user'],
                'type' => "success",
                'texto' => "Ya hemos activado tu subcripción ".$producto->nombre." .Tendrás activados estos privilegios desde el día ".$fecha_inicio." hasta el día ".$fecha_fin." (incluidos). Para renovar deberás comprarlo de nuevo una vez caduque la subscripción."
            ]);
            
           
            
        }
        
    }
}
