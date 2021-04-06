<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRegistrationRequest;
use App\Mail\MemberRegistrationOTPMail;
use App\Models\Member;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Ulid\Ulid;

class RegisterController extends Controller
{
  use ResponseTrait;

  public function register(MemberRegistrationRequest $request): JsonResponse
  {
    try {
      $user = new Member();
      $user->first_name = $request->input("first_name");
      $user->last_name = $request->input("last_name");
      $user->email = $request->input("email");
      $user->telephone = $request->input("telephone") ?: NULL;
      $user->password = Hash::make($request->input("password"));
      $user->token = generate_mask(100000, 999999);
      $user->token_at = Carbon::now();
      $user->mask = Ulid::fromTimestamp(time());
      $user->save();

      // Send email to user
      Mail::to($user->email)->send(new MemberRegistrationOTPMail($user));

      return $this->successDataResponse("Registration successful", [
        "otp" => $user->token,
        "otp_at" => $user->token_at,
        "user_id" => $user->uuid
      ]);

    } catch (\Exception $e) {
      return $this->exceptionResponse($e, "An error occurred while creating your account.");
    }
  }

  public function verifyAccount(Request $request, string $userId)
  {
    try {

    }
    catch (\Exception $e) {
      return $this->exceptionResponse($e);
    }
  }
}
