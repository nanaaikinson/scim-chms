<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Person extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  use SoftDeletes;

  protected $guarded = [];
  protected $appends = ["name"];

  /**
   * Get Name of Person
   *
   * @return string
   */
  public function getNameAttribute(): string
  {
    return "{$this->first_name} {$this->last_name}";
  }

  public function groups(): BelongsToMany
  {
    return $this->belongsToMany(Group::class, "group_people", "person_id", "group_id");
  }

  public function families(): BelongsToMany
  {
    return $this->belongsToMany(Family::class, "family_people", "person_id", "family_id");
  }

  public function familyPersons(): HasMany
  {
    return $this->hasMany(FamilyPerson::class);
  }

  public function groupPersons(): HasMany
  {
    return $this->hasMany(GroupPerson::class);
  }

  public function attendancePersons(): HasMany
  {
    return $this->hasMany(AttendancePerson::class);
  }

  public function followUps(): HasMany
  {
    return $this->hasMany(FollowUp::class);
  }

  public function avatar(): MorphOne
  {
    return $this->morphOne('App\Models\Image', 'imageable');
  }

  public function contributions(): HasMany
  {
    return $this->hasMany(Contribution::class);
  }
}
