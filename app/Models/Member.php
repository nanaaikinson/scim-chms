<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Member extends Authenticatable implements JWTSubject, HasMedia
{
  use Notifiable, InteractsWithMedia;

  protected $guarded = [];

  public function avatar(): MorphOne
  {
    return $this->morphOne('App\Models\Image', 'imageable');
  }

  public function getNameAttribute(): string
  {
    return "{$this->first_name} {$this->last_name}";
  }

  public function getUUIDAttribute(): string
  {
    return "{$this->mask}";
  }

  /**
   * Get the identifier that will be stored in the subject claim of the JWT.
   *
   * @return mixed
   */
  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  /**
   * Return a key value array, containing any custom claims to be added to the JWT.
   *
   * @return array
   */
  public function getJWTCustomClaims(): array
  {
    return [];
  }

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('thumb')
      ->width(250)
      ->height(250);
  }
}
