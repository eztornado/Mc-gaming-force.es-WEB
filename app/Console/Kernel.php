<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
        $schedule->command('check:servers')->everyFiveMinutes();  
        $schedule->command('telegrambot:run')->everyFiveMinutes(); 
        $schedule->command('tienda:procesar_cola')->everyFiveMinutes(); 
        $schedule->command('usuarios_online:fix')->everyFiveMinutes(); 
        $schedule->command('tienda:anular_subscripciones')->dailyAt('23:00');
        $schedule->command('srv:eliminar_cuentas')->hourly();
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
