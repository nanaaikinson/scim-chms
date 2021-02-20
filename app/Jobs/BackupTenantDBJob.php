<?php

namespace App\Jobs;

use App\Tenant;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
    $tenants = Tenant::all();
    $date = Carbon::now()->format("Y-m-d");

    foreach ($tenants as $tenant) {
      $data = json_decode($tenant->data);
      $filename = "{$data->tenancy_db_name}_{$date}.sql";

      try {
        MySql::create()
          ->setDbName($data->tenancy_db_name)
          ->setUserName(config("database.connections.mysql.username"))
          ->setPassword(config("database.connections.mysql.password"))
          ->dumpToFile(storage_path("app/public/") . $filename);

        if (Storage::disk("public")->exists($filename)) {
          $contents = Storage::disk("public")->get($filename);
          Storage::disk("s3")->put("tenants/", $contents);
          Storage::disk("public")->delete($filename);
        }
      }
      catch (\Exception $e) {
        // TODO: send email on failure
        continue;
      }
    }
  }
}
