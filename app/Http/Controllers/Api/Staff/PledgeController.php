<?php

namespace App\Http\Controllers\Api\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\PledgeRequest;
use App\Http\Requests\StorePledgeRequest;
use App\Models\Pledge;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PledgeController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    try {
      $pledges = Pledge::all()->map(function ($pledge) {
        return [
          "id" => $pledge->id,
          "mask" => $pledge->mask,
          "title" => $pledge->title,
          "amount" => $pledge->amount,
          "purpose" => $pledge->purpose,
        ];
      });
      return $this->dataResponse($pledges);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(PledgeRequest $request)
  {
    try {
      $validated = (object)$request->validationData();
      $pledge = Pledge::create([
        "title" => $validated->title,
        "amount" => $validated->amount,
        "purpose" => $validated->purpose ?: NULL,
        "mask" => generate_mask(),
      ]);

      if ($pledge) {
        return $this->successResponse("Pledge created successfully");
      }
      return $this->errorResponse("An error occurred while adding this pledge");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(int $mask)
  {
    try {
      $pledge = Pledge::where("mask", $mask)->firstOrFail();
      return $this->dataResponse([
        "mask" => $pledge->mask,
        "title" => $pledge->title,
        "amount" => $pledge->amount,
        "purpose" => $pledge->purpose
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this pledge");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(PledgeRequest $request, int $mask)
  {
    try {
      $pledge = Pledge::where("mask", $mask)->firstOrFail();
      $validated = (object)$request->validationData();

      $pledge->title = $validated->title;
      $pledge->amount = $validated->amount;
      $pledge->purpose = $validated->purpose ?: NULL;

      if ($pledge->save()) {
        return $this->successResponse("Pledge updated successfully");
      }
      return $this->errorResponse("An error occurred while updating this pledge");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this pledge");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(int $mask)
  {
    try {
      $pledge = Pledge::where("mask", $mask)->firstOrFail();
      if ($pledge->delete()) {
        return $this->successResponse("Pledge deleted successfully");
      }
      return $this->errorResponse("An error occurred while deleting this pledge");
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse("No data found for this pledge");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
