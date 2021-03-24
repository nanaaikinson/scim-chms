<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrayerRequest;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrayerRequestController extends Controller
{
  use ResponseTrait;

  public function index(Request $request): JsonResponse
  {
    try {
      $perPage = $request->input("per_page") ?: 20;
      $prayers = PrayerRequest::paginate($perPage);

      $prayers = $prayers->toArray();
      $items = $prayers["data"];
      $prayers["items"] = $items;
      unset($prayers["data"]);
      unset($prayers["links"]);

      return $this->dataResponse($prayers);
    } catch (\Exception $e) {
      return $this->errorResponse($e);
    }
  }

  public function show(string $mask): JsonResponse
  {
    try {
      $prayer = PrayerRequest::where("mask", $mask)->firstOrFail();
      return $this->dataResponse($prayer);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    } catch (\Exception $e) {
      return $this->errorResponse($e);
    }
  }

  public function destroy(string $mask): JsonResponse
  {
    try {
      $prayer = PrayerRequest::where("mask", $mask)->firstOrFail();
      $prayer->delete();

      return $this->successResponse("Prayer request deleted successfully.");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    } catch (\Exception $e) {
      return $this->errorResponse($e);
    }
  }
}
