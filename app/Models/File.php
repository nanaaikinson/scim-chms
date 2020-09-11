<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
  protected $guarded = [];

  /**
   * Get the owning fileable model.
   */
  public function fileable()
  {
    return $this->morphTo();
  }
}
