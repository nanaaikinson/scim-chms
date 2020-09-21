<?php

namespace App\Http\Controllers\Api\Staff;

use App\Events\UserCreatedEvent;
use App\Http\Controllers\Controller;
use App\Mail\UserCreatedMail;
use App\Mail\UserCreation;
use App\Traits\ResponseTrait;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    try {
      $users = User::with("roles")->get()->map(function($user) {
        $role = $user->roles ? ($user->roles->isNotEmpty() ? $user->roles->pluck("display_name") : NULL) : NULL;

        return [
          "id" => (int)$user->id,
          "mask" => (int)$user->mask,
          "name" => "{$user->first_name} {$user->last_name}",
          "email" => $user->email,
          "role" => $role ? $role[0] : null,
          "telephone" => $user->telephone,
          "status" => $user->status == ST_ACTIVE ? "active" : "disabled"
        ];
      });
      return $this->dataResponse($users);
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(Request $request)
  {
    try {
      $rules = [
        "first_name" => "required",
        "last_name" => "required",
        "email" => "required|email|unique:users,email,NULL,id",
        "role" => "required|exists:roles,id",
        "telephone" => "nullable|min:10|numeric",
        "status" => "required|in:0,1"
      ];
      if (!$request->auto_password) $rules["password"] = "required|confirmed|min:6|max:20|alpha_num";

      $validator = Validator::make($request->all(), $rules, [
        "unique" => "There is an account associated with this :attribute"
      ]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      // Process data
      DB::beginTransaction();

      $password = $request->auto_password ? strtoupper(Str::random(10)) : $request->password;

      $user = new User();
      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->email = $request->email;
      $user->telephone = $request->telephone ?: null;
      $user->mask = generate_mask();
      $user->password = bcrypt($password);
      $user->status = (int)$request->status ?: ST_INACTIVE;

      if ($user->save()) {

        $user->attachRole($request->role);
        if ($request->auto_password || $request->notify_user) {
          // event(new UserCreatedEvent($user, $password));

          Mail::to($user->email)->queue(new UserCreatedMail([
            "name" => $user->first_name,
            "email" => $user->email,
            "password" => $password
          ]));
        }

        DB::commit();
        return $this->successResponse("User created successfully.");
      }
      DB::rollBack();
      return $this->errorResponse("An error occurred while saving this user");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $user = User::with("roles")->where("mask", $mask)->firstOrFail();
      $role = $user->roles->pluck("id");

      return $this->dataResponse([
        "mask" => (int)$user->mask,
        "first_name" => $user->first_name,
        "last_name" => $user->last_name,
        "email" => $user->email,
        "telephone" => $user->telephone,
        "status" => $user->status,
        "role" => $role ? $role[0] : null
      ]);
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No query data found for this user");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(Request $request, int $mask)
  {
    try {
      $user = User::with("roles")->where("mask", $mask)->firstOrFail();
      $rules = [
        "first_name" => "required",
        "last_name" => "required",
        "email" => "required|email|unique:users,email,{$user->id},id",
        "role" => "required|exists:roles,id",
        "telephone" => "nullable|min:10|numeric",
        "status" => "required|in:0,1"
      ];
      $validator = Validator::make($request->all(), $rules, [
        "unique" => "There is an account associated with this :attribute"
      ]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      // Process data
      DB::beginTransaction();

      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->email = $request->email;
      $user->telephone = $request->telephone ?: null;
      $user->status = (int)$request->status ?: ST_INACTIVE;

      if ($user->save()) {
        $user->syncRoles([$request->role]);

        DB::commit();
        return $this->successResponse("User updated successfully.");
      }
      DB::rollBack();
      return $this->errorResponse("An error occurred while updating this user");

    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No query data found for this user");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $user = User::with("roles")->where("mask", $mask)->firstOrFail();
      $role = $user->roles ? ($user->roles->isNotEmpty() ? $user->roles->pluck("id") : NULL) : NULL;

      DB::beginTransaction();
      if ($user->delete()) {
        if ($role) $user->detachRole($role[0]);

        DB::commit();
        return $this->successResponse("User deleted successfully");
      }
      DB::rollBack();
      return $this->errorResponse("An error occurred while deleting this user");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No query data found for this user");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
