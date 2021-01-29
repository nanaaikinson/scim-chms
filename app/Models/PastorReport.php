<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class PastorReport extends Model
{
  use CentralConnection;

  protected $guarded = [];
}
