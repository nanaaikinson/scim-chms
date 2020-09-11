<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FollowUp extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

  protected $guarded = [];

  public function person()
  {
    return $this->belongsTo(Person::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
