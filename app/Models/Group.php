<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Group extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

  protected $guarded = [];

  public function persons()
  {
    return $this->belongsToMany(Person::class, "group_people", "group_id", "person_id")
      ->withPivot(["leader"]);
  }

  public function groupPersons()
  {
    return $this->hasMany(GroupPerson::class);
  }
}
