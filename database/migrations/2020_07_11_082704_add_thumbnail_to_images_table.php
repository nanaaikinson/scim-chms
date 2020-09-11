<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThumbnailToImagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('images', function (Blueprint $table) {
      $table->string("thumbnail_url")->after("url")->nullable();
      $table->string("thumbnail_filename")->after("filename")->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('images', function (Blueprint $table) {
      //
    });
  }
}
