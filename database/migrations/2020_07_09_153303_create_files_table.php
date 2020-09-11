<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('files', function (Blueprint $table) {
      $table->id();
      $table->string('url')->nullable();
      $table->string('filename')->nullable();
      $table->string('file_type')->nullable();
      $table->bigInteger('fileable_id')->nullable();
      $table->string('fileable_type')->nullable();
      $table->unsignedBigInteger('mask')->unique();
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
    Schema::dropIfExists('files');
  }
}
