<?php

// Fake data
use Illuminate\Support\Facades\Route;

Route::get("/expenses", "ExpenseFakerController@index");
Route::get("/groups", "GroupFakerController@index");
Route::get("/people", "PersonFakerController@index");
Route::get("/attendances", "AttendanceFakerController@index");
Route::get("/contributions", "ContributionFakerController@index");
Route::get("/pledges", "PledgeFakerController@index");
