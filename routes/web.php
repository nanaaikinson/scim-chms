<?php

use App\Mail\BackupFailureMail;
use App\Mail\BackupSuccessfulMail;
use App\Tenant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Spatie\DbDumper\Databases\MySql;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("/", function () {
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
        dump("s3");
      }
    } catch (\Exception $e) {
      dump($e->getMessage());
    }
  }

  //return "App";
});

Route::get("pastors-report/download/{id}", "Api\Staff\Report\PastorReportController@index");

//Route::get("/books/{token}/download", "Api\BookController@download");
