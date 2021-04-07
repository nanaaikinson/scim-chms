<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->string("telephone")->after("password")->nullable();
      $table->boolean("is_facebook")->after("telephone")->default(false);
      $table->boolean("is_google")->after("is_facebook")->default(false);
      $table->boolean("status")->after("is_google")->default(false);
      $table->string("mask")->change();
      $table->string("token")->after("mask")->nullable();
      $table->dateTime("token_at")->after("token")->nullable();
      $table->string("country")->after("telephone")->nullable();
      $table->string("role")->after("country")->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      //
    });
  }
}
