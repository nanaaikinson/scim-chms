<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToMembersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('members', function (Blueprint $table) {
      $table->string("first_name")->after("id")->nullable();
      $table->string("last_name")->after("first_name")->nullable();
      $table->string("email")->after("last_name")->unique();
      $table->string("password")->after("email")->nullable();
      $table->string("telephone")->after("password")->nullable();
      $table->boolean("is_facebook")->after("telephone")->default(false);
      $table->boolean("is_google")->after("is_facebook")->default(false);
      $table->boolean("status")->after("is_google")->default(false);
      $table->string("mask")->after("status")->unique();
      $table->string("token")->after("mask")->nullable();
      $table->dateTime("token_at")->after("token")->nullable();
      $table->string("country")->after("telephone")->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('members', function (Blueprint $table) {
      //
    });
  }
}
