<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
  use ResponseTrait;

  public function index(Request $request)
  {

  }

  public function store(Request $request): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        "title" => "required",
        "image" => "required|mimes:jpg,jpeg,png|max:1024",
        "start_date_time" => "required|date_format:Y-m-d H:i:s",
        "end_date_time" => "nullable|date_format:Y-m-d H:i:s",
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
      ]);

      if ($event) {
        if ($request->hasFile("image")) {
          $event->addMediaFromRequest('image')->toMediaCollection('images');
        }
      }
    }
    catch (\Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
