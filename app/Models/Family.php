<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Family extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

  protected $guarded = [];

  public function persons()
  {
    return $this->belongsToMany(Person::class, "family_people", "family_id", "person_id");
  }

  public function familyPersons()
  {
    return $this->hasMany(FamilyPerson::class);

  }
}
