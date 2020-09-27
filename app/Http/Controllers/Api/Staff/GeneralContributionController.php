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
      $requestContributionType = $request->input("type") || "";
      $response = "";
      $type = "";

      switch (strtolower($requestContributionType)) {
        case "alter-seed":
          $type = ContributionTypeEnum::AlterSeed;
          $response = "Alter seed";
          break;
        case "offering":
          $type = ContributionTypeEnum::Offering;
          $response = "Offering";
          break;
        default:
          $type = ContributionTypeEnum::General;
          $response = "General";
          break;
      }

      foreach ($validated->contributions as $item) {
        $item = (object)$item;

        Contribution::create([
          "type" => $type,
          "amount" => $item->amount,
          "name" => $item->name,
          "comment" => isset($item->comment) ? $item->comment : NULL,
          "date" => $item->date,
          "mask" => generate_mask(),
          "method" => isset($item->method) ? $item->method : ContributionMethodEnum::Cash
        ]);
      }

      return $this->successResponse("{$response} contribution(s) saved successfully");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $contribution = Contribution::where("mask", $mask)->firstOrFail();

      return [
        "name" => $contribution->name,
        "amount" => $contribution->amount,
        "date" => $contribution->date,
        "mask" => $contribution->mask,
        "comment" => $contribution->comment,
        "method" => $contribution->method,
      ];
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this contribution");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(UpdateGeneralContributionRequest $request, int $mask)
  {
    try {
      $validated = (object)$request->validationData();
      $contribution = Contribution::where("mask", $mask)->firstOrFail();

      $contribution->name = $validated->name;
      $contribution->date = $validated->date;
      $contribution->comment = $validated->comment;
      $contribution->amount = $validated->amount;
      $contribution->method = $validated->method ?: ContributionMethodEnum::Cash;

      if ($contribution->save()) {
        return $this->successResponse("Contribution updated successfully");
      }
      return $this->errorResponse("An error occurred while updating this contribution");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this contribution");
    } catch (Exception $e) {
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
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this contribution");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
