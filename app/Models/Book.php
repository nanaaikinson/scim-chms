<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Book extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

  protected $guarded = [];

  /**
   * Get the series' image.
   */
  public function image()
  {
    return $this->morphOne('App\Models\Image', 'imageable');
  }

  /**
   * Get the series' image.
   */
  public function file()
  {
    return $this->morphOne('App\Models\File', 'fileable');
  }
}
