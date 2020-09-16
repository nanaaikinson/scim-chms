<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["json.response"])->group(function () {
  Route::prefix("auth")->group(function() {
    Route::post("/login", "AuthController@login");
    Route::post("/register", "AuthController@register");
    Route::post("/verify-token", "AuthController@verifyToken");
  });

  /*Route::middleware("auth:api")->group(function() {
    Route::get("/sermons", "SermonController@sermons");
    Route::post("/prayer-request", "PrayerRequestController@store");
  });*/

  Route::get("/sermons", "SermonController@sermons");
  Route::post("/prayer-request", "PrayerRequestController@store");
});
