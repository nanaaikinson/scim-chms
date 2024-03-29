<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
  use ResponseTrait;

  /*public function index(): JsonResponse
  {
    try {
      $apiUrl = config('services.wp.api_url') . "/tribe/events/v1/events";
      $response = Http::get($apiUrl);

      return $this->dataResponse($response->json());
    } catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }*/

  public function index(Request $request): JsonResponse
  {
    try {
      $perPage = 20;
      $query = Event::query();
      $events = $query->whereDate("start_date_time", ">=", now())->paginate($perPage);

      $events->getCollection()->transform(function($event) {
        $mediaItems = $event->getMedia("images");
        return [
          "title" => $event->title,
          "description" => $event->description,
          "location" => $event->location,
          "organizer" => $event->organizer,
          "start_date_time" => $event->start_date_time,
          "end_date_time" => $event->end_date_time,
          "primary_contact" => $event->primary_contact,
          "secondary_contact" => $event->secondary_contact,
          "mask" => $event->mask,
          "image" => $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl() : null,
          "thumbnail" => $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl("thumb") : null,
        ];
      });

      $events = $events->toArray();
      $items = $events["data"];
      $events["items"] = $items;
      unset($events["data"]);
      unset($events["links"]);

      return $this->dataResponse($events);
    }
    catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(string $mask): JsonResponse
  {
    try {
      $event = Event::where("mask", $mask)->firstOrFail();
      $mediaItems = $event->getMedia("images");

      $event->setAttribute("image", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl() : null);
      $event->setAttribute("thumbnail", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl("thumb") : null);

      return $this->dataResponse($event);
    }
    catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    }
    catch (\Exception $e) {
      return $this->exceptionResponse($e);
    }
  }
}
