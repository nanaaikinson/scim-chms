<?php

namespace App\Http\Controllers\Api\Staff;

use App\Enums\ContributionMethodEnum;
use App\Enums\ContributionTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePledgeContributionRequest;
use App\Http\Requests\UpdatePledgeContributionRequest;
use App\Models\Contribution;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PledgeContributionController extends Controller
{
  use ResponseTrait;

  public function store(StorePledgeContributionRequest $request)
  {
    try {
      $validated = (object) $request->validationData();

      foreach ($validated->contributions as $item) {
        $item = (object)$item;
        $contribution = new Contribution();
        $contribution->type = ContributionTypeEnum::Pledge;
        $contribution->person_id = $item->person;
        $contribution->pledge_id = $item->pledge;
        $contribution->date = $item->date ?: NULL;
        $contribution->comment = $item->comment ?: NULL;
        $contribution->amount = $item->amount;
        $contribution->method = $item->method ?: ContributionMethodEnum::Cash;
        $contribution->mask = generate_mask();
        $contribution->save();
      }

      return $this->successResponse("Pledge contribution(s) saved successfully");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $contribution = Contribution::with("person")->with("pledge")->where("mask", $mask)
        ->where("type", ContributionTypeEnum::Pledge)
        ->firstOrFail();

      return $this->dataResponse([
        "mask" => (int)$contribution->mask,
        "date" => $contribution->date,
        "amount" => (float)$contribution->amount,
        "comment" => $contribution->comment,
        "method" => $contribution->method,
        "person" => [
          "id" => $contribution->person->id,
          "name" => "{$contribution->person->first_name} {$contribution->person->last_name}"
        ],
        "pledge" => [
          "id" => $contribution->pledge->id,
          "name" => $contribution->pledge->name
        ]
      ]);
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this pledge contribution");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(UpdatePledgeContributionRequest $request, int $mask)
  {
    try {
      $validated = (object)$request->validationData();

      $contribution = Contribution::where("mask", $mask)->where("type", ContributionTypeEnum::Pledge)->firstOrFail();

      $contribution->person_id = $validated->person;
      $contribution->date = $validated->date;
      $contribution->comment = $validated->comment;
      $contribution->amount = $validated->amount;
      $contribution->method = $validated->method;
      $contribution->pledge_id = $validated->pledge;

      if ($contribution->save()) {
        return $this->successResponse("Pledge contribution updated successfully");
      }
      return $this->errorResponse("An error occurred while updating this pledge contribution");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this pledge contribution");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $contribution = Contribution::where("mask", $mask)->where("type", ContributionTypeEnum::Pledge)->firstOrFail();
      if ($contribution->delete()) {
        return $this->successResponse("Pledge contribution deleted successfully");
      }
      return $this->errorResponse("An error occurred while deleting this pledge contribution");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this pledge contribution");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
