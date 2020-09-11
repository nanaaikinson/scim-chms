<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookSeries extends Model
{
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
