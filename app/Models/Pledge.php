<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Pledge extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

  protected $guarded = [];
  protected $appends = ["paid", "balance"];

  public function person(): BelongsTo
  {
    return $this->belongsTo(Person::class);
  }

  public function contributions(): HasMany
  {
    return $this->hasMany(Contribution::class);
  }

  /**
   * Get Amount Paid By Person
   *
   * @return float
   */
  public function getPaidAttribute(): float
  {
    return $this->contributions()->sum("amount");
  }

  /**
   * Get Pledge Balance
   *
   * @return float
   */
  public function getBalanceAttribute(): float
  {
    $paid = $this->getPaidAttribute();
    $balance = $this->amount - $paid;

    if ($this->amount > $paid) return (float)-$balance;
    return (float)$balance;
  }
}
