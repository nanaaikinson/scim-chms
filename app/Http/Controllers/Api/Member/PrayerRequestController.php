<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidatePrayerRequest;
use App\Mail\PrayerRequestMail;
use App\Models\PrayerRequest;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Ulid\Ulid;

class PrayerRequestController extends Controller
{
  use ResponseTrait;

  public function store(ValidatePrayerRequest $request): JsonResponse
  {
    try {
      $data = [
        "name" => $request->input("name"),
        "subject" => $request->input("subject"),
        "email" => $request->input("email"),
        "telephone" => $request->input("telephone"),
        "request" => $request->input("request")
      ];

      PrayerRequest::create([
        "name" => $request->input("name"),
        "phone" => $request->input("telephone"),
        "email" => $request->input("email"),
        "request" => $request->input("request"),
        "subject" => $request->input("subject"),
        "mask" => (string)Ulid::fromTimestamp(time(), true)
      ]);

      Mail::to(getenv("SCIM_ADMIN_EMAIL"))->send(new PrayerRequestMail($data));

      return $this->successResponse("Prayer request received. We'll contact you as soon as possible. Jesus Is Alive");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
