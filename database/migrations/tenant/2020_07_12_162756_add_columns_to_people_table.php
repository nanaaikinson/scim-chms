<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPeopleTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('people', function (Blueprint $table) {
      $table->string("first_name")->after("id")->nullable();
      $table->string("last_name")->after("first_name")->nullable();
      $table->string("email")->after("last_name")->nullable();
      $table->string("password")->after("email")->nullable();
      $table->string("middle_name")->after("password")->nullable();
      $table->date("date_of_birth")->after("email")->nullable()->default(null);
      $table->string("gender")->after("date_of_birth")->nullable()->default('male');
      $table->string("grade")->after("date_of_birth")->nullable();
      $table->string("marital_status")->nullable();
      $table->date("baptism_date")->nullable()->default(null);
      $table->date("join_date")->nullable()->default(null);
      $table->string("employer")->nullable();
      $table->string("occupation")->nullable();
      $table->string("primary_telephone")->nullable();
      $table->string("secondary_telephone")->nullable();
      $table->string("postal_address")->nullable();
      $table->string("physical_address")->nullable();
      $table->string("tithe_number")->nullable();
      $table->tinyInteger("member_status")->nullable()->default(1);
      $table->unsignedBigInteger("mask")->unique();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('people', function (Blueprint $table) {
      //
    });
  }
}
