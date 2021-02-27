<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BackupFailureJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public function handle()
  {
    Mail::raw('Backup failed @ '. \Carbon\Carbon::now(), function ($message) {
      $message->to("nanaaikinson24@gmail.com")->subject("SCIM Scheduled Backup Failure");
    });
  }
}
