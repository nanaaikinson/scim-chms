<?php

namespace App\Http\Controllers\Api\Staff;

use App\Enums\GroupTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupPerson;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    try {
      $groups = Group::with("persons")->get()->map(function ($group) {

        $leader = null;
        if ($group->persons) {
          foreach ($group->persons as $person) {
            if ($person->pivot->leader == ST_TRUE) {
              $leader = "{$person->first_name} {$person->last_name}";
            }
          }
        }

        return [
          "id" => (int)$group->id,
          "mask" => (int)$group->mask,
          "name" => $group->name,
          "type" => $group->type ? (GroupTypeEnum::fromValue($group->type))->description : "",
          "description" => $group->description,
          "created_at" => gmdate("Y-m-d", strtotime($group->created_at)),
          "persons" => $group->persons ? $group->persons->count() : 0,
          "leader" => $leader
        ];
      });
      return $this->dataResponse($groups);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(Request $request)
  {
    try {
      $rules = [
        "name" => "required|unique:groups,name,NULL,id",
        "leader" => "nullable|exists:people,id",
        "type" => "required",
      ];
      $validator = Validator::make($request->all(), $rules, [
        "unique" => "This :attribute already exists",
        "exists" => "The :attribute selected does not exist"
      ]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      // Process data
      DB::beginTransaction();

      $group = new Group();
      $group->name = $request->name;
      $group->description = $request->description ?: null;
      $group->type = $request->type ?: GroupTypeEnum::Men;
      $group->mask = generate_mask();

      if ($group->save()) {
        if ($request->leader) {
          GroupPerson::create(["person_id" => $request->leader, "group_id" => $group->id, "leader" => ST_TRUE]);
        }

        DB::commit();
        return $this->successResponse("Group created successfully");
      }
      DB::rollBack();
      return $this->errorResponse("An error occurred while creating this group");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $group = Group::with("persons")->where("mask", $mask)->firstOrFail();

      $leader = null;
      if ($group->persons) {
        foreach ($group->persons as $person) {
          if ($person->pivot->leader == ST_TRUE) {
            $leader = ["id" => $person->id, "name" => "{$person->first_name} {$person->last_name}"];
          }
        }
      }

      return $this->dataResponse([
        "mask" => (int)$mask,
        "name" => $group->name,
        "description" => $group->description,
        "type" => $group->type,
        "leader" => $leader
      ]);

    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this group");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(Request $request, int $mask)
  {
    try {
      $group = Group::with("groupPersons")->where("mask", $mask)->firstOrFail();
      $rules = [
        "name" => "required|unique:groups,name,{$group->id},id",
        "leader" => "nullable|exists:people,id",
        "type" => "required",
      ];
      $validator = Validator::make($request->all(), $rules, [
        "unique" => "This :attribute already exists",
        "exists" => "The :attribute selected does not exist"
      ]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      // Process data
      DB::beginTransaction();

      $group->name = $request->name;
      $group->description = $request->description ?: null;
      $group->type = $request->type ?: GroupTypeEnum::Men;

      if ($group->save()) {

        // Set group leader
        if ($request->leader) {
          $personExist = $group->groupPersons->where("person_id", (int)$request->leader)->first();

          if ($personExist) {
            foreach ($group->groupPersons as $groupPerson) {
              // If group person is same as request leader
              if ($groupPerson->person_id == $request->leader) {
                $groupPerson->leader = ST_TRUE;
              } else {
                $groupPerson->leader = ST_FALSE;
              }
              $groupPerson->save();
            }
          } else {
            foreach ($group->groupPersons as $groupPerson) {
              $groupPerson->leader = ST_FALSE;
              $groupPerson->save();
            }

            GroupPerson::create(["person_id" => $request->leader, "group_id" => $group->id, "leader" => ST_TRUE]);
          }
        }

        DB::commit();
        return $this->successResponse("Group created successfully");
      }
      DB::rollBack();
      return $this->errorResponse("An error occurred while creating this group");
    }
    catch(ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this group");
    }
    catch(Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $group = Group::with("groupPersons")->where("mask", $mask)->firstOrFail();
      $groupPersons = $group->groupPersons;

      DB::beginTransaction();

      if ($group->delete()) {
        foreach ($groupPersons as $groupPerson) {
          $groupPerson->delete();
        }
        DB::commit();
        return $this->successResponse("Group deleted successfully");
      }

      DB::rollBack();
      return $this->errorResponse("An error occurred while deleting this group");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this group");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
