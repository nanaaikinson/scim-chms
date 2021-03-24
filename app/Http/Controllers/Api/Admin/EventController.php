<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ulid\Ulid;

class EventController extends Controller
{
  use ResponseTrait;

  public function index(Request $request): JsonResponse
  {
    try {
      $perPage = $request->input("per_page") ?: 20;
      $currentPage = $request->input("page") ?: 1;
      $device = $request->input("device") ?: null;
      $query = Event::query();

      if ($device == "mobile") {
        $query->whereDate("start_date_time", ">=", now());
      }

      $events = $query->paginate($perPage, ["*"], "page", $currentPage);
      $events->getCollection()->transform(function ($event) {
        $mediaItems = $event->media;

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
          "image" => $mediaItems ? $mediaItems[0]->getFullUrl() : null,
          "thumbnail" => $mediaItems ? $mediaItems[0]->getFullUrl("thumb") : null,
        ];
      });

      $events = $events->toArray();
      $items = $events["data"];
      $events["items"] = $items;
      unset($events["data"]);
      unset($events["links"]);

      return $this->dataResponse($events);
    } catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        "title" => "required",
        "image" => "required|mimes:jpg,jpeg,png|max:1024",
        "start_date_time" => "required|date_format:Y-m-d H:i",
        "end_date_time" => "nullable|date_format:Y-m-d H:i",
        "location" => "required",
        "organizer" => "required",
        "primary_contact" => "required",
      ]);

      if ($validator->fails()) {
        return $this->validationResponse($validator->errors());
      }

      $event = Event::create([
        "title" => $request->input("title"),
        "description" => $request->input("description"),
        "location" => $request->input("location"),
        "organizer" => $request->input("organizer"),
        "start_date_time" => $request->input("start_date_time") ?: NULL,
        "end_date_time" => $request->input("start_date_time") ?: NULL,
        "primary_contact" => $request->input("primary_contact") ?: NULL,
        "secondary_contact" => $request->input("secondary_contact") ?: NULL,
        "mask" => (string)Ulid::fromTimestamp(time(), true),
      ]);

      if ($request->hasFile("image")) {
        $event->addMediaFromRequest('image')->toMediaCollection('images');
      }

      $mediaItems = $event->getMedia("images");

      $event->setAttribute("image", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl() : null);
      $event->setAttribute("thumbnail", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl("thumb") : null);

      return $this->successDataResponse("Event created successfully", $event);
    } catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show(string $mask): JsonResponse
  {
    try {
      $event = Event::mask($mask)->firstOrFail();
      $mediaItems = $event->getMedia("images");
      $event->fresh();

      $event->setAttribute("image", $mediaItems ? $mediaItems[0]->getFullUrl() : null);
      $event->setAttribute("thumbnail", $mediaItems ? $mediaItems[0]->getFullUrl("thumb") : null);

      return $this->dataResponse($event);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    } catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(Request $request, string $mask): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        "title" => "required",
        "image" => "nullable|mimes:jpg,jpeg,png|max:1024",
        "start_date_time" => "required|date_format:Y-m-d H:i",
        "end_date_time" => "nullable|date_format:Y-m-d H:i",
        "location" => "required",
        "organizer" => "required",
        "primary_contact" => "required",
      ]);

      if ($validator->fails()) {
        return $this->validationResponse($validator->errors());
      }

      $event = Event::mask($mask)->firstOrFail();
      $event->update([
        "title" => $request->input("title"),
        "description" => $request->input("description"),
        "location" => $request->input("location"),
        "organizer" => $request->input("organizer"),
        "start_date_time" => $request->input("start_date_time") ?: NULL,
        "end_date_time" => $request->input("start_date_time") ?: NULL,
        "primary_contact" => $request->input("primary_contact") ?: NULL,
        "secondary_contact" => $request->input("secondary_contact") ?: NULL,
      ]);

      if ($request->hasFile("image")) {
        $mediaItems = $event->getMedia("images");
        if ($mediaItems->isNotEmpty()) $mediaItems[0]->delete();
        $event->addMediaFromRequest('image')->toMediaCollection('images');
      }

      $mediaItems = $event->getMedia("images");

      $event->setAttribute("image", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl() : null);
      $event->setAttribute("thumbnail", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl("thumb") : null);


      return $this->successDataResponse("Event updated successfully", $event);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    } catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy(string $mask): JsonResponse
  {
    try {
      $event = Event::mask($mask)->firstOrFail();
      $event->delete();

      return $this->successResponse("Event deleted successfully");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    } catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
