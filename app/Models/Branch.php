<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Branch extends Model
{
  use CentralConnection;

  protected $guarded = [];
}
