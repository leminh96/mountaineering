<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\accounts\Accounts;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        
        
        
        $schedule->command('cleanup:deactivated')->everyMinute()->before(function () {
            Log::info('Start cleanup:deactivated');
        })
        ->after(function () {
            Log::info('End cleanup:deactivated');
        }); 






        // $schedule->call(function () {

        //   info("excecuting");
        // })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
