<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPerson extends Model
{
  protected $guarded = [];

  public function groups()
  {
    return $this->belongsToMany(Group::class);
  }

  public function people()
  {
    return $this->belongsToMany(Person::class);
  }
}
