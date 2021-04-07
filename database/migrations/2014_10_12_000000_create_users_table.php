<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('first_name');
      $table->string('last_name');
      $table->string('email')->unique();
      $table->string('password');
      $table->string("telephone")->nullable();
      $table->boolean("is_facebook")->default(false);
      $table->boolean("is_google")->default(false);
      $table->string("token")->nullable();
      $table->dateTime("token_at")->nullable();
      $table->string("country")->nullable();
      $table->string("role")->nullable();
      $table->string('mask')->unique();
      $table->rememberToken();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
