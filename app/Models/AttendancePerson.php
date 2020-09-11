<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendancePerson extends Model
{
  protected $guarded = [];

  public function attendance()
  {
    return $this->belongsTo(Attendance::class);
  }

  public function person()
  {
    return $this->belongsTo(Person::class);
  }
}
