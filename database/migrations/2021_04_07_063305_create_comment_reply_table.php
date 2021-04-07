<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentReplyTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('comment_replies', function (Blueprint $table) {
      $table->id();
      $table->foreignId("comment_id")->constrained()->cascadeOnDelete();
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
    Schema::dropIfExists('comment_replies');
  }
}
