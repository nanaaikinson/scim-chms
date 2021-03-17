<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaskToPrayerRequestsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('prayer_requests', function (Blueprint $table) {
      $table->string("mask")->unique()->nullable()->default(null);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('prayer_requests', function (Blueprint $table) {
      $table->dropUnique('prayer_requests_mask_unique');
    });
  }
}
