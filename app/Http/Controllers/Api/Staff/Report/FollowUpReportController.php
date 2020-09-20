<?php

namespace App\Http\Controllers\Api\Staff\Report;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;

class FollowUpReportController extends Controller
{
  use ResponseTrait;

  public function index(Request $request)
  {
    try {
      
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
