<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
  public $guarded = [];

  public function module()
  {
    return $this->belongsTo(Module::class);
  }
}
