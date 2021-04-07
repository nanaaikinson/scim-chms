<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Models\Article;
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
