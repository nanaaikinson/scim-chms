<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
  use ResponseTrait;

  public function me(Request $request)
  {

  }

  public function update(Request $request)
  {

  }

  public function updateAvatar(Request $request): JsonResponse
  {
    $validator = Validator::make($request->all(), ["avatar" => "required|mimes:jpg,jpeg,png|max:2048"]);
    if ($validator->fails()) return $this->validationResponse($validator->errors());

    try {
      $user = $request->user();

      $user->addMediaFromRequest("avatar")->toMediaCollection("avatar");

      $avatar = ($user->getMedia("avatar"))[0]->getFullUrl();

      return $this->dataResponse(["avatar" => $avatar]);
    } catch (\Exception $e) {
      return $this->exceptionResponse($e);
    }
  }
}
