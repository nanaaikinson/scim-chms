<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["json.response"])->group(function () {
  Route::prefix("auth")->group(function() {
    Route::post("/login", "AuthController@login");
    Route::post("/register", "AuthController@register");
    Route::post("/verify-token", "AuthController@verifyToken");
  });
});
