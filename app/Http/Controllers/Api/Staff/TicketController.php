<?php

namespace App\Http\Controllers\Api\Staff;

use App\Classes\FileManagerTenancy;
use App\Enums\TicketTagEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Mail\DeveloperTicketMail;
use App\Models\Ticket;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TicketController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    try {
      $tenantId = tenant("id");
      $tickets = Ticket::with("image")->where("tenant_id", $tenantId)->get()->map(function ($record) use ($tenantId) {
        $image = $record->image ? getenv("APP_URL") . "/" .$tenantId. $record->image->url : NULL;
        return [
          "mask" => (int)$record->mask,
          "title" => $record->title,
          "description" => $record->description,
          "status" => $record->status,
          "tag" => $record->tag ? (TicketTagEnum::fromValue($record->tag))->description : null,
          "image" => $image
        ];
      });
      return $this->dataResponse($tickets);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(StoreTicketRequest $request)
  {
    try {
      $tenantId = tenant("id");
      $user = $request->user();
      $validated = (object)$request->validationData();

      DB::beginTransaction();
      $ticket = Ticket::create([
        "title" => $validated->title,
        "description" => $request->input("description"),
        "tag" => $validated->tag,
        "tenant_id" => $tenantId,
        "mask" => generate_mask(),
      ]);

      // Upload image
      $image = null;
      $slug = Str::slug($validated->title, "-");
      if ($request->hasFile("image")) {
        $image = FileManagerTenancy::uploadFile($request->file("image"), "tickets", $slug, "tenancy");
      }

      if ($ticket) {
        if (!is_null($image)) {
          $ticket->image()->create(["url" => $image->url, "filename" => $image->path, "mask" => generate_mask()]);
        }

        // Send email to devs
        //$this->sendMail($ticket, $user, $tenantId, "Created");

        DB::commit();
        return $this->successResponse("Ticket created successfully");
      }

      DB::rollBack();
      return $this->errorResponse("An error occurred while creating this ticket");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show($mask)
  {
    try {
      $tenantId = tenant("id");
      $ticket = Ticket::with("image")
        ->where("mask", $mask)
        ->where("tenant_id", $tenantId)
        ->firstOrFail();
      $image = $ticket->image ? getenv("APP_URL") . $ticket->image->url : NULL;

      return $this->dataResponse([
        "mask" => (int)$ticket->mask,
        "title" => $ticket->title,
        "description" => $ticket->description,
        "tag" => $ticket->tag,
        "image" => $image
      ]);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(StoreTicketRequest $request, $mask)
  {
    try {
      $tenantId = tenant("id");
      $user = $request->user();
      $ticket = Ticket::with("image")
        ->where("mask", $mask)
        ->where("tenant_id", $tenantId)
        ->firstOrFail();
      $validated = (object)$request->validationData();

      DB::beginTransaction();
      $ticket->title = $validated->title;
      $ticket->description = $request->input("description");
      $ticket->tag = $validated->tag;
      $ticket->tenant_id = $tenantId;

      // Upload image
      $image = null;
      $slug = Str::slug($validated->title, "-");
      if ($request->hasFile("image")) {
        $image = FileManagerTenancy::uploadFile($request->file("image"), "tickets", $slug, "central");
      }

      if ($ticket->save()) {
        // Create if file is not null
        if (!is_null($image)) {
          if ($ticket->image) {
            FileManagerTenancy::deleteFile($ticket->image->filename, "central");
            $ticket->image()->delete();
          }
          $ticket->image()->create(["url" => $image->url, "filename" => $image->path, "mask" => generate_mask()]);
        }

        // Send email to devs
        $this->sendMail($ticket, $user, $tenantId, "Updated");

        DB::commit();
        return $this->successResponse("Ticket updated successfully");
      }

      DB::rollBack();
      return $this->errorResponse("An error occurred while updating this ticket");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function sendMail($ticket, $user, $tenantId, $action = "Created")
  {
    $devs = getenv("DEVS_EMAILS") ? explode(",", getenv("DEVS_EMAILS")) : [];
    foreach ($devs as $dev) {
      Mail::to($dev)->queue(new DeveloperTicketMail([
        "action" => $action,
        "ticket" => (object)[
          "id" => $ticket->id,
          "title" => $ticket->title,
          "description" => $ticket->description,
          "tag" => (TicketTagEnum::fromValue((int)$ticket->tag))->description
        ],
        "user" => (object)[
          "name" => "{$user->first_name} {$user->last_name}",
          "branch" => getenv("APP_URL") . "/" . $tenantId
        ]
      ]));
    }
  }
}
