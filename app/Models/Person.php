<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Person extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  use SoftDeletes;

  protected $guarded = [];

  public function groups()
  {
    return $this->belongsToMany(Group::class, "group_people", "person_id", "group_id");
  }

  public function families()
  {
    return $this->belongsToMany(Family::class, "family_people", "person_id", "family_id");
  }

  public function familyPersons()
  {
    return $this->hasMany(FamilyPerson::class);
  }

  public function groupPersons()
  {
    return $this->hasMany(GroupPerson::class);
  }

  public function attendancePersons()
  {
    return $this->hasMany(AttendancePerson::class);
  }

  public function followUps()
  {
    return $this->hasMany(FollowUp::class);
  }

  public function avatar()
  {
    return $this->morphOne('App\Models\Image', 'imageable');
  }

  public function contributions()
  {
    return $this->hasMany(Contribution::class);
  }
}
