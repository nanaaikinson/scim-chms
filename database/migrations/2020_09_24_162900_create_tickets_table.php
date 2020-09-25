<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tickets', function (Blueprint $table) {
      $table->id();
      $table->string("title")->nullable();
      $table->text("description")->nullable();
      $table->string("tenant_id")->nullable();
      $table->string("status")->nullable()->default("open");
      $table->string("mask")->unique();
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
    Schema::dropIfExists('tickets');
  }
}
