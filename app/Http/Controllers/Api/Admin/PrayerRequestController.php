<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrayerRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrayerRequestController extends Controller
{
  use ResponseTrait;

  public function index(Request $request): JsonResponse
  {
    try {

    }
    catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
