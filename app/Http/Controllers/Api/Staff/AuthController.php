<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Mail\UserPasswordResetMail;
use App\Traits\ResponseTrait;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

/**
 * @group Authentication
 *
 * APIs for managing authentication
 */
class AuthController extends Controller
{
  use ResponseTrait;

  /**
   * User login
   *
   * @bodyParam email string required The email address of the user. Example: jdoe@example.com
   * @bodyParam password string required The password of the user. Example: TheBoyIsGoingToSchool#1992
   *
   * @response {
   * "code": 200,
   * "data": {
   *    "name": "Joe Doe",
   *    "email": "jdoe@example.com",
   *    "avatar": "http://scim.test/storage/images/john-doe-12345432.jpg",
   *    "token": eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiSm9obiBEb2UifQ.DjwRE2jZhren2Wt37t5hlVru6Myq4AhpGLiiefF69u8
   *  }
   * }
   *
   * @response status=422 scenario="Validation error(s)" {
   *  "errors": [
   *  "email": [
   *    "The email field is required",
   *    "The email field must be a valid email address"
   *  ],
   *  "password" : ["The password field is required"]
   *  ]
   * }
   *
   * @response status=400 scenario="Incorrect credentials"{
   *  "message": "Incorrect credentials provided"
   * }
   *
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {
    try {
      $rules = ["email" => "required|email", "password" => "required"];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errors = $validator->errors()->all();
        return $this->validationResponse($errors);
      }
      $credentials = request(["email", "password"]);
      if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->status == ST_ACTIVE) {
          $token = $user->createToken('Personal Access Token')->accessToken;
          $currency = (new SettingController())->currency();

          return $this->dataResponse([
            "token" => $token,
            "access_type" => "Bearer",
            "user" => [
              "name" => "{$user->first_name} {$user->last_name}",
              "email" => $user->email,
              "avatar" => "",
              "permissions" => $user->allPermissions()->pluck("name")
            ],
            "settings" => [
              "currency" => $currency->getData()->data
            ]
          ]);
        }
        return $this->errorResponse("Your account has been disabled. Kindly contact your administrator.");
      }
      return $this->errorResponse("Incorrect credentials provided.");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }


  /**
   * Request user password reset
   * @param Request $request
   */
  public function passwordReset(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), ["email" => "required|email"]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      $password = generate_mask();
      $user = User::where("email", $request->input("email"))->firstOrFail();
      $user->password = bcrypt($password);
      if ($user->save()) {

        // Send Email to user
        Mail::to($user->email)
          ->queue(new UserPasswordResetMail((object)["first_name" => $user->first_name, "password" => $password]));

        return $this->successResponse("An email has been sent to the supplied email address. Follow the instructions in the email to reset your password");
      }
      return $this->errorResponse("An error occurred while resetting your password");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("The email entered is not associated with any account!");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  /**
   * View current authenticated user
   *
   * @authenticated
   * @param Request $request
   * @return mixed
   */
  public function user(Request $request)
  {
    return $this->dataResponse($request->user());
  }

  /**
   * Logout current authenticated user
   *
   * @authenticated
   */
  public function logout()
  {
    $user = Auth::user()->token();
    $user->revoke();

    return $this->successResponse("Logout successful");
  }


  public function changePassword(Request $request)
  {
    try {
      $user = $request->user();
      $validator = Validator::make($request->all(), [
        "current_password" => "required",
        "password" => "required|confirmed|min:6|max:20"
      ]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      // Validate current password
      if (Hash::check($request->input("current_password"), $user->password)) {
        $user->password = Hash::make($request->input("password"));
        if ($user->save()) {
          return $this->successResponse("Password updated successfully.");
        }
        return $this->errorResponse("An error occurred while updating your password");
      }
      return $this->errorResponse("The current password entered is incorrect");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function changeDetails(Request $request)
  {
    try {
      $user = $request->user();
      $validator = Validator::make($request->all(), [
        "first_name" => "required",
        "last_name" => "required",
        "email" => "required|email|unique:users,email,{$user->id},id"
      ]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->email = $request->email;
      $user->telephone = $request->telephone;
      if ($user->save()) {
        return $this->successResponse("Details updated successfully");
      }

      return $this->errorResponse("An error occurred while updating your details");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
