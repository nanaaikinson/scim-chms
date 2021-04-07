<?php

use Illuminate\Support\Facades\Route;

// Admin Routes
Route::prefix("admin")->group(function () {
  Route::prefix("branches")->group(function () {
    Route::post("/", "Api\Admin\BranchController@store");
  });

  Route::prefix("events")->group(function () {
    Route::get("/", "Api\Admin\EventController@index");
    Route::post("/", "Api\Admin\EventController@store");
    Route::get("/{mask}", "Api\Admin\EventController@show");
    Route::post("/{mask}", "Api\Admin\EventController@update");
    Route::delete("/{mask}", "Api\Admin\EventController@destroy");
  });

  Route::prefix("blogs")->group(function () {
    Route::get("/", "Api\Admin\ArticleController@index");
    Route::post("/", "Api\Admin\ArticleController@store");
    Route::get("/{mask}", "Api\Admin\ArticleController@show");
    Route::post("/{mask}", "Api\Admin\ArticleController@update");
    Route::delete("/{mask}", "Api\Admin\ArticleController@destroy");
  });

  Route::prefix("prayer-requests")->group(function () {
    Route::get("/", "Api\Admin\PrayerRequestController@index");
    Route::get("/{mask}", "Api\Admin\PrayerRequestController@show");
    Route::delete("/{mask}", "Api\Admin\PrayerRequestController@destroy");
  });
});

// Mobile Routes
Route::prefix("mobile")->group(function () {
  Route::prefix("events")->group(function() {
    Route::get("/", "Api\Member\EventController@index");
    Route::get("/{mask}", "Api\Member\EventController@show");
  });
  Route::post("/prayer-request", "Api\Member\PrayerRequestController@store");

  Route::prefix("auth")->group(function() {
    Route::post("/login", "Api\Member\LoginController@login");
    Route::post("/register", "Api\Member\RegisterController@register");
    Route::post("/verify-otp", "Api\Member\VerificationController@verifyOtp");
    Route::post("/resend-otp", "Api\Member\VerificationController@resendOtp");
    Route::post("/social/{provider}", "Api\Member\SocialAuthController@handle");
  });

  Route::middleware("auth:member-api")->group(function () {
    // Profile
    Route::prefix("profile")->group(function() {
      Route::get("/", "Api\Member\ProfileController@me");
      Route::post("/update-avatar", "Api\Member\ProfileController@updateAvatar");
      Route::patch("/update-details", "Api\Member\ProfileController@update");
    });
  });
});
