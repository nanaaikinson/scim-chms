<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
  use ResponseTrait;

  public function index(): JsonResponse
  {
    try {
      $apiUrl = config('services.wp.api_url') . "/tribe/events/v1/events";
      $response = Http::get($apiUrl);

      return $this->dataResponse($response->json());
    } catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
