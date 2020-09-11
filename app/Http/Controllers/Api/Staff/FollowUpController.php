<?php

namespace App\Http\Controllers\Api\Staff;

use App\Enums\FollowUpEnum;
use App\Http\Controllers\Controller;
use App\Models\FollowUp;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FollowUpController extends Controller
{
  use ResponseTrait;

  public function index(Request $request)
  {
    try {
      $followUps = FollowUp::with("person")->with("user")->get()->map(function ($follow) {
        $person = $follow->person ? "{$follow->person->first_name} {$follow->person->last_name}" : "";
        $user = $follow->user ? "{$follow->user->first_name} {$follow->user->last_name}" : "";

        return [
          "mask" => $follow->mask,
          "person" => $person,
          "assigned_to" => $user,
          "date" => $follow->date,
          "comment" => $follow->comment,
          "type" => follow_up_type($follow->type),
          "status" => $follow->completed == ST_TRUE ? "Done" : "Pending",
          "completion_date" => $follow->completion_date,
        ];
      });

      return $this->dataResponse($followUps);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(Request $request)
  {
    try {
      $rules = [
        "people" => "required|array",
        "people.*" => "exists:people,id",
        "date" => "required|date|date_format:Y-m-d",
        "assigned_to" => "required|exists:users,id"
      ];
      if ($request->completed == ST_TRUE) {
        $rules["completion_date"] = "required|date";
      }
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      // Process data
      foreach ($request->people as $person) {
        FollowUp::create([
          "person_id" => $person,
          "date" => $request->date,
          "user_id" => $request->assigned_to,
          "type" => $request->type ?: FollowUpEnum::Visit,
          "completed" => $request->completed ?: ST_FALSE,
          "comment" => $request->comment ?: NULL,
          "completion_date" => $request->completion_date ?: NULL,
          "mask" => generate_mask(),
        ]);
      }

      return $this->successResponse("Follow up created successfully");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $followUp = FollowUp::where("mask", $mask)->firstOrFail();
      return $this->dataResponse([
        "mask" => $followUp->mask,
        "person_id" => $followUp->person_id,
        "date" => $followUp->date,
        "type" => $followUp->type,
        "user_id" => $followUp->user_id,
        "completed" => $followUp->completed,
        "comment" => $followUp->comment,
        "completion_date" => $followUp->completion_date,
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this follow up");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(Request $request, int $mask)
  {
    try {
      $followUp = FollowUp::where("mask", $mask)->firstOrFail();
      $rules = [
        "date" => "required|date|date_format:Y-m-d",
        "assigned_to" => "required|exists:users,id",
      ];
      if ($request->completed == ST_TRUE) {
        $rules["completion_date"] = "required|date";
      }
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      $followUp->date = $request->date;
      $followUp->user_id = $request->assigned_to;
      $followUp->type = $request->type ?: FollowUpEnum::Visit;
      $followUp->completed = $request->completed ?: ST_FALSE;
      $followUp->comment = $request->comment;
      $followUp->completion_date = $request->completion_date ?: NULL;

      if ($followUp->save()) {
        return $this->successResponse("Follow-up updated successfully");
      }
      return $this->errorResponse("An error occurred while updating this follow-up");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this follow-up");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $followUp = FollowUp::where("mask", $mask)->firstOrFail();
      if ($followUp->delete()) {
        return $this->successResponse("Follow-up deleted successfully");
      }
      return $this->errorResponse("An error occurred while deleting this follow-up");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this follow-up");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
