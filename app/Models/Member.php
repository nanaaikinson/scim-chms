<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Member extends Authenticatable
{
  use HasApiTokens, Notifiable;

  protected $guarded = [];

  public function avatar()
  {
    return $this->morphOne('App\Models\Image', 'imageable');
  }
}
