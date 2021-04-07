<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  use ResponseTrait;

  public function index(Request $request)
  {
  }

  public function show(string $mask)
  {
  }

  public function comment(Request $request, string $mask)
  {
  }
}
