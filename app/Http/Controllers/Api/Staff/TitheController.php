<?php

namespace App\Http\Controllers\Api\Staff;

use App\Enums\ContributionMethodEnum;
use App\Enums\ContributionTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTitheRequest;
use App\Http\Requests\UpdateTitheRequest;
use App\Models\Contribution;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TitheController extends Controller
{
  use ResponseTrait;

  public function index(Request $request)
  {
    try {

      $contributions = Contribution::where("type", ContributionTypeEnum::Tithe)->get();

      // getCollection() is a method available in Illuminate\Pagination\LengthAwarePaginator
      // It retreives the Collection instance the Paginator will iterate over, allowing you to
      // use Collection methods. transform() modifies the collection itself.
      /*$contributions->getCollection()->transform(function($user, $key) {
        return [
          'name' => $user->name,
          'email' => $user->email,
          'custom_attribute' => 'custom value',
        ];
      });*/

      return $this->dataResponse($contributions);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(StoreTitheRequest $request)
  {
    try {
      $validated = (object)$request->validationData();

      foreach ($validated->tithes as $item) {
        $item = (object)$item;
        $contribution = new Contribution();
        $contribution->type = ContributionTypeEnum::Tithe;
        $contribution->person_id = $item->person;
        $contribution->date = $item->date ?: NULL;
        $contribution->comment = $item->comment ?: NULL;
        $contribution->frequency = $item->frequency;
        $contribution->amount = $item->amount;
        $contribution->method = $item->method ?: ContributionMethodEnum::Cash;
        $contribution->mask = generate_mask();
        $contribution->save();
      }

      return $this->successResponse("Tithe(s) saved successfully");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $contribution = Contribution::with("person")->where("mask", $mask)
        ->where("type", ContributionTypeEnum::Tithe)
        ->firstOrFail();

      return $this->dataResponse([
        "mask" => (int)$contribution->mask,
        "date" => $contribution->date,
        "amount" => (float)$contribution->amount,
        "frequency" => $contribution->frequency,
        "comment" => $contribution->comment,
        "method" => $contribution->method,
        "person" => [
          "id" => $contribution->person->id,
          "name" => "{$contribution->person->first_name} {$contribution->person->last_name}"
        ]
      ]);
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this tithe");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(UpdateTitheRequest $request, int $mask)
  {
    try {
      $validated = (object)$request->validationData();
      $contribution = Contribution::where("mask", $mask)->where("type", ContributionTypeEnum::Tithe)->firstOrFail();

      $contribution->person_id = $validated->person;
      $contribution->date = $validated->date;
      $contribution->comment = $validated->comment;
      $contribution->frequency = $validated->frequency;
      $contribution->amount = $validated->amount;
      $contribution->method = $validated->method ?: ContributionMethodEnum::Cash;

      if ($contribution->save()) {
        return $this->successResponse("Tithe updated successfully");
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
      $contribution = Contribution::where("mask", $mask)->where("type", ContributionTypeEnum::Tithe)->firstOrFail();
      if ($contribution->delete()) {
        return $this->successResponse("Tithe deleted successfully");
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
