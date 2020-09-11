<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToPeopleTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('people', function (Blueprint $table) {
      $table->string("next_of_kin_name")->nullable();
      $table->string("next_of_kin_telephone")->nullable();
      $table->string("emergency_telephone")->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('people', function (Blueprint $table) {
      //
    });
  }
}
