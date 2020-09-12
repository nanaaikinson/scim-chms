<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('branches', function (Blueprint $table) {
      $table->id();
      $table->string("name")->unique();
      $table->string("tenant_id")->nullable();
      $table->string("subdomain")->nullable();
      $table->unsignedBigInteger("country_id")->nullable();
      $table->string("domain")->nullable();
      $table->boolean("status")->default(true);
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
    Schema::dropIfExists('branches');
  }
}
