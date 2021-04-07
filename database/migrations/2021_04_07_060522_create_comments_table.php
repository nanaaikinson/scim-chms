<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->foreignId("article_id")->nullable()->constrained()->cascadeOnDelete();
      $table->foreignId("user_id")->nullable()->constrained()->cascadeOnDelete();
      $table->text("body")->nullable();
      $table->string("mask")->unique();
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
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    Schema::dropIfExists('comments');
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}
