<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Mail\MemberOTPMail;
use App\Models\Member;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{
  use ResponseTrait;

  public function resendOtp(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), ["email" => "required|email"]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      $user = Member::where("email", $request->input("email"))->firstOrFail();
      $token = $tokenAt = "";

      if ($user) {
        $token = generate_mask(100000, 999999);
        $tokenAt = Carbon::now();

        $user->token = $token;
        $user->token_at = $tokenAt;
        $user->save();

        Mail::to($user->email)->send(new MemberOTPMail($user));
      }

      return $this->successDataResponse("An email has been sent to the email address provided.", [
        "otp" => $token,
        "otp_at" => $tokenAt,
        "user_id" => $user->mask
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    } catch (\Exception $e) {
      return $this->exceptionResponse($e);
    }

  }

  public function verifyOtp(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        "email" => "required|email",
        "otp" => "required|numeric"
      ]);
      if ($validator->fails()) {
        return $this->validationResponse($validator->errors());
      }

      $otp = $request->input("otp");
      $user = Member::where("email", $request->input("email"))->firstOrFail();
      if ($user->token == $otp) {
        $now = Carbon::now();
        $tokenAt = Carbon::parse($user->token_at);

        if ($now->diffInMinutes($tokenAt) <= 20) {
          $user->update([
            "status" => 1,
            "token" => null,
            "token_at" => null
          ]);

          return $this->successResponse("OTP verified. Account activated.");
        }
        throw new \Exception("OTP provided has expired. Please request for a new one.");
      }
      throw new \Exception("OTP provided is incorrect. Please type in the correct OTP or request for a new one.");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("The user queried does not exist.");
    } catch (\Exception $e) {
      return $this->exceptionResponse($e);
    }
  }
}
