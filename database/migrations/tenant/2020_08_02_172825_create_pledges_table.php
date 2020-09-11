<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePledgesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pledges', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->text('purpose')->nullable();
      $table->decimal('amount', 8, 2)->nullable();
      $table->unsignedBigInteger("mask")->unique();
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
    Schema::dropIfExists('pledges');
  }
}
