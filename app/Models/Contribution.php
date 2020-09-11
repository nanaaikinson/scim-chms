<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Contribution extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  use SoftDeletes;

  protected $guarded = [];

  public function person()
  {
    return $this->belongsTo(Person::class);
  }

  public function group()
  {
    return $this->belongsTo(Group::class);
  }

  public function pledge()
  {
    return $this->belongsTo(Pledge::class)->when("type",function ($q){

    });
  }
}
