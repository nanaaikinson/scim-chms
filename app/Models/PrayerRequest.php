<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
  protected $guarded = [];

  protected $hidden = ["id", "updated_at"];
}
