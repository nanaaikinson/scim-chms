<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('events', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->text('description')->nullable();
      $table->string('location')->nullable();
      $table->string('organizer')->nullable();
      $table->dateTime("start_date_time")->nullable();
      $table->dateTime("end_date_time")->nullable();
      $table->string('primary_contact')->nullable();
      $table->string('secondary_contact')->nullable();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('events');
  }
}
