<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  protected $guarded = [];

  /**
   * Get the owning imageable model.
   */
  public function imageable()
  {
    return $this->morphTo();
  }
}
