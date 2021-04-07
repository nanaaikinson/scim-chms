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
      ->height(100)->sharpen(10);

    $this->addMediaConversion('thumb_md')
      ->width(250)
      ->height(250)->sharpen(10);

    $this->addMediaConversion('thumb_lg')
      ->width(400)
      ->height(400)->sharpen(10);

    $this->addMediaCollection('images')->singleFile();
  }

  public function scopeMask($query, $mask)
  {
    return $query->where("mask", $mask);
  }
}
