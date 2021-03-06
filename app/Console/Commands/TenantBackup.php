<?php

namespace App\Console\Commands;

use App\Tenant;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Spatie\DbDumper\Databases\MySql;

class TenantBackup extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'scim:tenant-backup';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Backup scim tenants db';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  public function handle()
  {
    $date = Carbon::now()->format("Y-m-d_h-i-s");

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
        }
      } catch (\Exception $e) {
        dump($e->getMessage());
      }
    }

    $this->info('scim:tenant-backup Command Run successfully!');
  }
}
