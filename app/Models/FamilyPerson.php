<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyPerson extends Model
{
  protected $guarded = [];

  public function person()
  {
    return $this->belongsTo(Person::class);
  }
}
