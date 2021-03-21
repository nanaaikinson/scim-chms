<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Mail\MemberResendOTPMail;
use App\Models\Member;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{
  use ResponseTrait;

  public function resendVerification(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), ["email" => "required|email"]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      $user = Member::where("email", $request->input("email"))->first();
      $token = $tokenAt = "";

      if ($user) {
        $token = generate_mask(100000);
        $tokenAt = Carbon::now();

        $user->token = $token;
        $user->token_at = $tokenAt;
        $user->save();

        Mail::to($user->email)->send(new MemberResendOTPMail($user));
      }

      return $this->successDataResponse("An email has been sent to the email address provided.", [
        "otp" => $token,
        "otp_at" => $tokenAt,
        "user_id" => $user->uuid
      ]);
    } catch (\Exception $e) {
      return $this->exceptionResponse($e);
    }

  }

  public function verifyToken(Request $request)
  {

  }
}
