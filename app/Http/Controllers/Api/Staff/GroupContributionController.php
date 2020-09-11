<?php

namespace App\Http\Controllers\Api\Staff;

use App\Enums\ContributionMethodEnum;
use App\Enums\ContributionTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupContributionRequest;
use App\Http\Requests\UpdateGroupContributionRequest;
use App\Models\Contribution;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GroupContributionController extends Controller
{
  use ResponseTrait;

  public function store(StoreGroupContributionRequest $request)
  {
    try {
      $validated = (object)$request->validationData();

      foreach ($validated->contributions as $item) {
        $item = (object)$item;
        $contribution = new Contribution();
        $contribution->type = ContributionTypeEnum::Group;
        $contribution->person_id = $item->person;
        $contribution->group_id = $item->group;
        $contribution->date = $item->date ?: NULL;
        $contribution->comment = $item->comment ?: NULL;
        $contribution->method = $item->method ?: ContributionMethodEnum::Cash;
        $contribution->amount = $item->amount;
        $contribution->mask = generate_mask();
        $contribution->save();
      }

      return $this->successResponse("Group contribution(s) saved successfully");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $contribution = Contribution::with("person")->with("group")->where("mask", $mask)
        ->where("type", ContributionTypeEnum::Group)
        ->firstOrFail();

      return $this->dataResponse([
        "mask" => (int)$contribution->mask,
        "date" => $contribution->date,
        "amount" => (float)$contribution->amount,
        "comment" => $contribution->comment,
        "method" => $contribution->method,
        "person" => $contribution->person ? [
          "id" => $contribution->person->id,
          "name" => "{$contribution->person->first_name} {$contribution->person->last_name}"
        ] : "",
        "group" => [
          "id" => $contribution->group->id,
          "name" => $contribution->group->name
        ]
      ]);
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this group contribution");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }


  public function update(UpdateGroupContributionRequest $request, int $mask)
  {
    try {
      $validated = (object)$request->validationData();
      $contribution = Contribution::where("mask", $mask)->where("type", ContributionTypeEnum::Group)->firstOrFail();

      $contribution->person_id = $validated->person;
      $contribution->date = $validated->date;
      $contribution->comment = $validated->comment;
      $contribution->amount = $validated->amount;
      $contribution->group_id = $validated->group;
      $contribution->method = $validated->method ?: ContributionMethodEnum::Cash;

      if ($contribution->save()) {
        return $this->successResponse("Group contribution updated successfully");
      }
      return $this->errorResponse("An error occurred while updating this group contribution");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this group contribution");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $contribution = Contribution::where("mask", $mask)->where("type", ContributionTypeEnum::Group)->firstOrFail();
      if ($contribution->delete()) {
        return $this->successResponse("Group contribution deleted successfully");
      }
      return $this->errorResponse("An error occurred while deleting this group contribution");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this group contribution");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
