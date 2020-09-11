<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Role;
use App\Models\RoleUser;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RoleController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    try {
      $roles = Role::all()->map(function ($role) {
        $users = RoleUser::where("role_id", $role->id)->count();

        return [
          "id" => (int)$role->id,
          "mask" => (int)$role->mask,
          "name" => $role->display_name,
          "users" => $users,
          "created_at" => gmdate("Y-m-d", strtotime($role->created_at))
        ];
      });
      return $this->dataResponse($roles);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(Request $request)
  {
    try {
      $rules = [
        "name" => "required|unique:roles,name,NULL,id",
        "permissions" => "required|array",
        "permissions.*" => "exists:permissions,id"
      ];
      $validator = Validator::make($request->all(), $rules, ["unique" => "You already have a role with the same name."]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      // Process Data
      $role = new Role();
      $role->name = Str::slug($request->name);
      $role->display_name = $request->name;
      $role->description = $request->description ?: null;
      $role->mask = generate_mask();

      if ($role->save()) {
        $role->syncPermissions($request->permissions);
        return $this->successResponse("Role created successfully.");
      }
      return $this->errorResponse("An error occurred while saving this role.");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show($mask)
  {
    try {
      $role = Role::where("mask", (int)$mask)->firstOrFail();
      $permissions = $role->permissions->pluck("id");

      return $this->dataResponse([
        "mask" => (int)$role->mask,
        "name" => $role->display_name,
        "description" => $role->description,
        "permissions" => $permissions
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No results for this");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(Request $request, $mask)
  {
    try {
      $role = Role::where("mask", (int)$mask)->firstOrFail();

      $rules = ["name" => "required|unique:roles,name,{$role->id},id", "permissions" => "required"];
      $validator = Validator::make($request->all(), $rules, ["unique" => "You already have a role with the same name."]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      // Process Data
      $role->name = Str::slug($request->name);
      $role->display_name = $request->name;
      $role->description = $request->description ?: null;

      if ($role->save()) {
        $role->syncPermissions($request->permissions);
        return $this->successResponse("Role updated successfully.");
      }
      return $this->errorResponse("An error occurred while updating this role.");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No results for this");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy($mask)
  {
    try {
      $role = Role::where("mask", (int)$mask)->firstOrFail();
      if ($role->delete()) {

        $role->users()->sync([]); // Delete relationship data
        $role->permissions()->sync([]); // Delete relationship data
        $role->forceDelete();

        return $this->successResponse("Role deleted successfully.");
      }
      return $this->errorResponse("An error occurred while deleting this role.");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No results for this");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function permissions()
  {
    try {
      $modules = Module::with("permissions")->get()->map(function ($module) {
        $permissions = $module->permissions->map(function ($permission) {
          return ["id" => $permission->id, "name" => $permission->display_name];
        });

        return ["module" => $module->name, "permissions" => $permissions];
      });
      return $this->dataResponse($modules);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
