<?php

namespace App\Http\Controllers\Api\Staff;

use App\Enums\ContributionMethodEnum;
use App\Enums\ContributionTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContributionRequest;
use App\Http\Requests\UpdateContributionRequest;
use App\Models\Contribution;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BusingController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    try {
      $contribution = Contribution::where("type", ContributionTypeEnum::Busing)->get();

      return $this->dataResponse($contribution);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(StoreContributionRequest $request)
  {
    try {
      $validated = (object)$request->validationData();

      foreach ($validated->contributions as $item) {
        $item = (object)$item;
        $contribution = new Contribution();
        $contribution->type = ContributionTypeEnum::Busing;
        $contribution->person_id = $item->person;
        $contribution->date = $item->date ?: NULL;
        $contribution->comment = $item->comment ?: NULL;
        $contribution->amount = (float)$item->amount;
        $contribution->method = $item->method ?: ContributionMethodEnum::Cash;
        $contribution->mask = generate_mask();
        $contribution->save();
      }

      return $this->successResponse("Busing contribution(s) saved successfully");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $contribution = Contribution::with("person")->where("mask", $mask)
        ->where("type", ContributionTypeEnum::Busing)
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
        ]
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this busing contribution");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(UpdateContributionRequest $request, int $mask)
  {
    try {
      $validated = (object)$request->validationData();
      $contribution = Contribution::where("mask", $mask)->where("type", ContributionTypeEnum::Busing)->firstOrFail();

      $contribution->person_id = $validated->person;
      $contribution->date = $validated->date;
      $contribution->comment = $validated->comment;
      $contribution->amount = $validated->amount;
      $contribution->method = $validated->method ?: ContributionMethodEnum::Cash;

      if ($contribution->save()) {
        return $this->successResponse("Busing contribution updated successfully");
      }
      return $this->errorResponse("An error occurred while updating this contribution");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this tithe");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $tithe = Contribution::where("mask", $mask)->where("type", ContributionTypeEnum::Busing)->firstOrFail();
      if ($tithe->delete()) {
        return $this->successResponse("Busing contribution deleted successfully");
      }
      return $this->errorResponse("An error occurred while deleting this tithe");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this tithe");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
