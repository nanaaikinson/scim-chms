<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookLinksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('book_links', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('book_id')->nullable();
      $table->smallInteger('downloaded')->default(0);
      $table->string('url')->nullable();
      $table->string('token')->nullable();
      $table->unsignedBigInteger('mask')->unique();
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
    Schema::dropIfExists('book_links');
  }
}
