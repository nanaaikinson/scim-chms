<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidatePrayerRequest;
use App\Mail\PrayerRequestMail;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Facades\Mail;

class PrayerRequestController extends Controller
{
  use ResponseTrait;

  public function store(ValidatePrayerRequest $request)
  {
    try {
      $validated = (object)$request->validationData();
      $data = [
        "name" => $validated->name,
        "subject" => $validated->subject,
        "email" => $validated->email,
        "telephone" => $validated->telephone,
        "request" => $validated->request
      ];
      Mail::to(getenv("SCIM_ADMIN_EMAIL"))->queue(new PrayerRequestMail($data));
      return  $this->successResponse("Prayer request sent successfully.");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
