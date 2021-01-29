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

  public function store(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        "full_name" => "required",
        "email" => "nullable|email",
        "phone" => "required|numeric|min:10",
        "request" => "required"
      ]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      $prayerRequest = PrayerRequest::create([
        "name" => $request->input("full_name"),
        "email" => $request->input("email") ?: NULL,
        "phone" => $request->input("phone") ?: NULL,
        "request" => $request->input("request") ?: NULL,
      ]);

      if ($prayerRequest) {
        return $this->successResponse("Thanks for contacting us! We will be in touch with you shortly. Jesus is Alive.");
      }
      return $this->errorResponse("An error occurred while submitting your prayer request");
    }
    catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
