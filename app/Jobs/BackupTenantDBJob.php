<?php

namespace App\Jobs;

use App\Mail\BackupFailureMail;
use App\Mail\BackupSuccessfulMail;
use App\Tenant;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\DbDumper\Databases\MySql;

class BackupTenantDBJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $date = Carbon::now()->format("Y-m-d_h:i:s");

    foreach (Tenant::all()->toArray() as $tenant) {
      $data = (object)$tenant;
      $filename = "{$data->tenancy_db_name}_{$date}.sql";

      try {
        MySql::create()
          ->setDbName($data->tenancy_db_name)
          ->setUserName(config("database.connections.mysql.username"))
          ->setPassword(config("database.connections.mysql.password"))
          ->dumpToFile(storage_path("app/public/") . $filename);

        if (Storage::disk("public")->exists($filename)) {
          $contents = Storage::disk("public")->get($filename);

          Storage::disk("s3")->put("ScimChms/{$filename}", $contents);
          Storage::disk("public")->delete($filename);

          Mail::to("nanaaikinson24@gmail.com")->send(new BackupSuccessfulMail($data->tenancy_db_name));
        }
        continue;
      } catch (\Exception $e) {
        Mail::to("nanaaikinson24@gmail.com")->send(new BackupFailureMail($data->tenancy_db_name, $e->getMessage()));
        continue;
      }
    }
  }
}
