<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
  public function app()
  {
    return view("app");
  }

  public function tenant()
  {
    return view("tenant.index");
  }
}
