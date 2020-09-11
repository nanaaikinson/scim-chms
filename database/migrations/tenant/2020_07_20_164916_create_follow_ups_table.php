<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('follow_ups', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("user_id")->nullable();
      $table->unsignedBigInteger("person_id")->nullable();
      $table->tinyInteger("type")->nullable();
      $table->boolean("completed")->nullable()->default(0);
      $table->text("comment")->nullable();
      $table->date("date")->nullable();
      $table->date("completion_date")->nullable();
      $table->unsignedBigInteger("mask")->nullable()->unique();
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
    Schema::dropIfExists('follow_ups');
  }
}
