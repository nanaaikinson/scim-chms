<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
  use ResponseTrait;

  public function handle(Request $request, string $provider)
  {

  }
}
