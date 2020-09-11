<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMembersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('members', function (Blueprint $table) {
      $table->string("first_name")->nullable();
      $table->string("last_name")->nullable();
      $table->string("email")->unique()->nullable();
      $table->string("telephone")->unique()->nullable();
      $table->string("password")->nullable();
      $table->string("token")->nullable();
      $table->dateTime("token_at")->nullable();
      $table->dateTime("email_verified_at")->nullable();
      $table->string("mask")->unique();
      $table->boolean("status")->nullable()->default(0);
      $table->text("meta_data")->nullable();
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
