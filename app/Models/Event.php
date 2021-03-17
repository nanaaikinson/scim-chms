<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
  use InteractsWithMedia;

  protected $guarded = [];
  protected $hidden = ["media", "id", "updated_at"];

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('thumb')
      ->width(100)
      ->height(100);
  }

  public function scopeMask($query, $mask)
  {
    return $query->where("mask", $mask);
  }
}
