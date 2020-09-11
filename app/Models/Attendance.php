<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Attendance extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  use SoftDeletes;

  protected $guarded = [];

  public function attendancePersons()
  {
    return $this->hasMany(AttendancePerson::class);
  }

  public function persons()
  {
    return $this->belongsToMany(Person::class, "attendance_people", "attendance_id", "person_id");
  }

  public function group()
  {
    return $this->belongsTo(Group::class);
  }
}
