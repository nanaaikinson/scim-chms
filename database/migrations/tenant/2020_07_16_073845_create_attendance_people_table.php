<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancePeopleTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('attendance_people', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("attendance_id")->nullable();
      $table->unsignedBigInteger("person_id")->nullable();
      $table->boolean("status")->default(1);
      $table->text("comment")->nullable();
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
    Schema::dropIfExists('attendance_people');
  }
}
