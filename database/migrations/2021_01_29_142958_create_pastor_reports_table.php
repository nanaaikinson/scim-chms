<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePastorReportsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pastor_reports', function (Blueprint $table) {
      $table->id();
      $table->string("tenant")->nullable();
      $table->string("user")->nullable();
      $table->string("title")->nullable();
      $table->string("type")->nullable();
      $table->date("date")->nullable();
      $table->string("filename")->nullable();
      $table->string("filepath")->nullable();
      $table->string("url")->nullable();
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
    Schema::dropIfExists('pastor_reports');
  }
}
