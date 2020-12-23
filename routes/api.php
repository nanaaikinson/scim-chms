<?php

use Illuminate\Support\Facades\Route;

Route::prefix("branches")->group(function() {
  Route::post("/", "Api\Admin\BranchController@store");
});

Route::post("/prayer-request", "Api\Admin\PrayerRequestController@store");

