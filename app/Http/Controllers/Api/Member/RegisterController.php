<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRegistrationRequest;
use App\Mail\MemberOTPMail;
use App\Models\Member;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Ulid\Ulid;

class RegisterController extends Controller
{
  use ResponseTrait;

  public function register(MemberRegistrationRequest $request): JsonResponse
  {
    try {
      $user = Member::create([
        "first_name" => $request->input("first_name"),
        "last_name" => $request->input("last_name"),
        "email" => $request->input("email"),
        "telephone" => $request->input("telephone"),
        "password" => Hash::make($request->input("password")),
        "token" => rand(100000, 999999),
        "token_at" => Carbon::now(),
        "mask" => (string)Ulid::fromTimestamp(time()),
      ]);

      // Send email to user
      Mail::to($user->email)->send(new MemberOTPMail($user));

      return $this->successDataResponse("Registration successful", [
        "otp" => $user->token,
        "otp_at" => $user->token_at,
        "user_id" => $user->mask
      ]);

    } catch (\Exception $e) {
      return $this->exceptionResponse($e, "An error occurred while creating your account.");
    }
  }
}
