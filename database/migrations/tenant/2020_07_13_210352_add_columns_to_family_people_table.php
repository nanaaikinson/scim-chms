<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToFamilyPeopleTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('family_people', function (Blueprint $table) {
      $table->unsignedBigInteger("family_id")->nullable();
      $table->unsignedBigInteger("person_id")->nullable();
      $table->string("relation")->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('family_people', function (Blueprint $table) {
      //
    });
  }
}
