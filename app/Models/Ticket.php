<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Ticket extends Model
{
  use CentralConnection;

  protected $guarded = [];

  public function image()
  {
    return $this->morphOne('App\Models\Image', 'imageable');
  }
}
