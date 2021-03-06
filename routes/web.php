<?php

use App\Tenant;
use Illuminate\Support\Facades\Route;

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
  
  //return "App";
  foreach (Tenant::all()->toArray() as $tenant) {
    $data = (object)$tenant;

    print_r($data);
  }
});

Route::get("pastors-report/download/{id}", "Api\Staff\Report\PastorReportController@index");

//Route::get("/books/{token}/download", "Api\BookController@download");
