<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('contributions', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('person_id')->nullable();
      $table->unsignedBigInteger('group_id')->nullable();
      $table->unsignedBigInteger('pledge_id')->nullable();
      $table->smallInteger('type')->nullable();
      $table->string('frequency')->nullable();
      $table->text('comment')->nullable();
      $table->date('date')->nullable();
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
    Schema::dropIfExists('contributions');
  }
}
