<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
  use HasFactory;
  use InteractsWithMedia;

  protected $guarded = [];
  protected $hidden = ["id", "media"];

  public function comments(): HasMany
  {
    return $this->hasMany(Comment::class);
  }

  public function likes(): HasMany
  {
    return $this->hasMany(Like::class);
  }

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('thumb')
      ->width(250)
      ->height(250)
      ->sharpen(10);

    $this->addMediaCollection('excerpt_image')->singleFile();
  }

  public function scopeMask($query, string $mask)
  {
    return $query->where("mask", $mask);
  }
}
