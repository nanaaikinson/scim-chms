<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('likes', function (Blueprint $table) {
      $table->id();
      $table->foreignId("article_id")->constrained()->cascadeOnDelete();
      $table->foreignId("admin_id")->constrained()->cascadeOnDelete();
      $table->foreignId("member_id")->constrained()->cascadeOnDelete();
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
    Schema::dropIfExists('likes');
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}
