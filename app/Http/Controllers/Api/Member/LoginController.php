<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
  use ResponseTrait;

  public function login(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->only(["email", "password"]), [
        "email" => "required|email",
        "password" => "required"
      ]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      $user = Member::where("email", $request->input("email"))->first();
      if ($user) {
        if (!$user->is_facebook && !$user->is_google) {
          if (Hash::check($request->input('password'), $user->password)) {
            if ($user->status) {
              $mediaItems = $user->getMedia("images");

              $token = JWTAuth::customClaims(['exp' => Carbon::now()->addDays(365)->timestamp])->fromUser($user);
              return $this->dataResponse([
                "name" => $user->name,
                "email" => $user->email,
                "avatar" => $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl("thumb") : null,
                "access_token" => $token
              ]);
            }
            throw new \Exception("Your account has not been verified. Verify by click on the verify my account button");
          }
          throw new \Exception("Invalid credentials provided.");
        }
        $social = $user->is_facebook ? 'facebook' : 'google';
        throw new \Exception("This account was registered using {$social}. Please sign in using that.");
      }
      throw new \Exception("Invalid credentials provided.");
    } catch (\Exception $e) {
      return $this->exceptionResponse($e);
    }
  }
}
