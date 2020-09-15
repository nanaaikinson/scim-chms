<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\MemberRegistrationRequest;
use App\Mail\MemberRegisteredMail;
use App\Models\Member;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  use ResponseTrait;

  public function register(MemberRegistrationRequest $request)
  {
    try {
      $validated = (object)$request->validationData();
      $password = Hash::make($validated->password);
      $metaData = [
        "client_ip" => $request->getClientIp(),
        "client_device" => $request->header("User-Agent"),
      ];

      DB::beginTransaction();
      $member = Member::create([
        "first_name" => $validated->first_name,
        "last_name" => $validated->last_name,
        "email" => $validated->email,
        "password" => $password,
        "telephone" => $request->telephone ?: NULL,
        "token" => generate_mask(),
        "token_at" => Carbon::now()->toDateString(),
        "status" => ST_INACTIVE,
        "mask" => Str::uuid(),
        "meta_data" => (string)json_encode($metaData)
      ]);

      if ($member) {
        Mail::to($member->email)->send(new MemberRegisteredMail([
          "name" => $member->first_name,
          "token" => $member->token,
        ]));

        DB::commit();
        return $this->successResponse(
          "Registration successful.
          \nYou need to verify your email to continue.
          \nIf you have not received the verification email, please check your \"Spam\" or \"Bulk Email\" folder."
        );
      }
      DB::rollBack();
      return $this->errorResponse("An error occurred while creating your account");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function login(MemberLoginRequest $request)
  {
    try {
      $validated = (object)$request->validationData();
      $member = Member::where("email", $validated->email)->with("avatar")->firstOrFail();
      if (Hash::check($validated->password, $member->password)) {
        if ($member->email_verified_at) {
          $token = $member->createToken("Member Login")->accessToken;
          return $this->dataResponse([
            "name" => "{$member->first_name} {$member->last_name}",
            "avatar" => $member->avatar,
            "token" => $token
          ]);
        }
        return $this->errorResponse("Your account is inactive. Verify your email to continue with your account.
        You can also click the resend verification email button to have another email sent to you");
      }
      throw new ModelNotFoundException();
    }
    catch (ModelNotFoundException $e) {
      return $this->errorResponse("Incorrect credentials provided");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function verifyToken(Request $request)
  {

  }
}
