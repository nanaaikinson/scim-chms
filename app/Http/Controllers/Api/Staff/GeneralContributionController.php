<?php

namespace App\Http\Controllers\Api\Staff;

use App\Enums\ContributionMethodEnum;
use App\Enums\ContributionTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGeneralContributionRequest;
use App\Http\Requests\UpdateGeneralContributionRequest;
use App\Models\Contribution;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GeneralContributionController extends Controller
{
  use ResponseTrait;

  public function store(StoreGeneralContributionRequest $request)
  {
    try {
      $validated = (object)$request->validationData();

      foreach ($validated->contributions as $item) {
        $item = (object)$item;

        Contribution::create([
          "type" => ContributionTypeEnum::General,
          "amount" => $item->amount,
          "name" => $item->name,
          "comment" => $item->comment,
          "date" => $item->date,
          "mask" => generate_mask(),
          "method" => $item->method ?: ContributionMethodEnum::Cash
        ]);
      }

      return $this->successResponse("General contribution(s) saved successfully");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $contribution = Contribution::where("mask", $mask)->where("type", ContributionTypeEnum::General)->firstOrFail();

      return [
        "name" => $contribution->name,
        "amount" => $contribution->amount,
        "date" => $contribution->date,
        "mask" => $contribution->mask,
        "comment" => $contribution->comment,
        "method" => $contribution->method,
      ];
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this contribution");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(UpdateGeneralContributionRequest $request, int $mask)
  {
    try {
      $validated = (object)$request->validationData();
      $contribution = Contribution::where("mask", $mask)->where("type", ContributionTypeEnum::General)->firstOrFail();

      $contribution->name = $validated->name;
      $contribution->date = $validated->date;
      $contribution->comment = $validated->comment;
      $contribution->amount = $validated->amount;
      $contribution->method = $validated->method ?: ContributionMethodEnum::Cash;

      if ($contribution->save()) {
        return $this->successResponse("Contribution updated successfully");
      }
      return $this->errorResponse("An error occurred while updating this contribution");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this contribution");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $tithe = Contribution::where("mask", $mask)->where("type", ContributionTypeEnum::General)->firstOrFail();
      if ($tithe->delete()) {
        return $this->successResponse("Contribution deleted successfully");
      }
      return $this->errorResponse("An error occurred while deleting this contribution");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this contribution");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
