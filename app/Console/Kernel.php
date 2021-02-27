<?php

namespace App\Console;

use App\Jobs\BackupFailureJob;
use App\Jobs\BackupTenantDBJob;
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
   * @param \Illuminate\Console\Scheduling\Schedule $schedule
   * @return void
   */
  protected function schedule(Schedule $schedule)
  {
    // $schedule->command('inspire')->hourly();

    // Back Up of project and sql
    $schedule->command('backup:clean')->daily()->at('10:00');
    $schedule->command('backup:run')->daily()->at('10:30');

//    $schedule->command('backup:run')->daily()->at('10:30')
//      ->onSuccess(function () {
//        dispatch(new BackupTenantDBJob());
//      })
//      ->onFailure(function () {
//        dispatch(new BackupFailureJob());
//      });
    $schedule->job(new BackupTenantDBJob)->daily()->at('11:40');
  }

  /**
   * Register the commands for the application.
   *
   * @return void
   */
  protected function commands()
  {
    $this->load(__DIR__ . '/Commands');

    require base_path('routes/console.php');
  }
}
