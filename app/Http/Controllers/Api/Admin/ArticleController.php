<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ulid\Ulid;

class ArticleController extends Controller
{
  use ResponseTrait;

  public function index(Request $request): JsonResponse
  {
    try {
      $perPage = $request->input("per_page") ?: 20;
      $currentPage = $request->input("page") ?: 1;
      $query = Article::query();

      $events = $query->paginate($perPage, ["*"], "page", $currentPage);
      $events->getCollection()->transform(function ($event) {
        $mediaItems = $event->getMedia("excerpt_image");

        return [
          "title" => $event->title,
          "mask" => $event->mask,
          "created_at" => $event->created_at,
          "excerpt_image" => $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl() : null,
          "excerpt_image_thumb" => $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl("thumb") : null,
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
        "body" => "required",
        "excerpt_image" => "nullable|mimes:jpg,jpeg,png|max:1024",
      ]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      $article = Article::create([
        "title" => $request->input("title"),
        "body" => $request->input("body"),
        "slug" => Str::slug($request->input("slug")),
        "mask" => (string)Ulid::fromTimestamp(time()),
      ]);

      if ($request->file("excerpt_image")) {
        $article->addMediaFromRequest('excerpt_image')->toMediaCollection('excerpt_image');
      }

      $mediaItems = $article->getMedia("excerpt_image");
      $article->setAttribute("excerpt_image", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl() : null);
      $article->setAttribute("excerpt_image_thumb", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl("thumb") : null);

      return $this->successDataResponse("Blog post created successfully.", $article);
    } catch (\Exception $e) {
      return $this->exceptionResponse($e);
    }
  }

  public function show(string $mask): JsonResponse
  {
    try {
      $article = Article::whereMask($mask)->firstOrFail();
      $mediaItems = $article->getMedia("excerpt_image");

      $article->setAttribute("excerpt_image", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl() : null);
      $article->setAttribute("excerpt_image_thumb", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl("thumb") : null);

      return $this->dataResponse($article);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    } catch (\Exception $e) {
      return $this->exceptionResponse($e);
    }
  }

  public function update(Request $request, string $mask): JsonResponse
  {
    try {
      $validator = Validator::make($request->all(), [
        "title" => "required",
        "body" => "required",
        "excerpt_image" => "nullable|mimes:jpg,jpeg,png|max:1024",
      ]);
      if ($validator->fails()) return $this->validationResponse($validator->errors());

      $article = Article::whereMask($mask)->firstOrFail();
      $mediaItems = $article->getMedia("excerpt_image");

      $article->update([
        "title" => $request->input("title"),
        "body" => $request->input("body"),
        "slug" => Str::slug($request->input("slug")),
      ]);

      if ($request->file("excerpt_image")) {
        $article->addMediaFromRequest('excerpt_image')->toMediaCollection('excerpt_image');
        if ($mediaItems->isNotEmpty()) {
          $mediaItems[0]->delete();
        }
      }

      $mediaItems = $article->getMedia("excerpt_image");
      $article->setAttribute("excerpt_image", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl() : null);
      $article->setAttribute("excerpt_image_thumb", $mediaItems->isNotEmpty() ? $mediaItems[0]->getFullUrl("thumb") : null);

      return $this->successDataResponse("Blog post updated successfully.", $article);
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    } catch (\Exception $e) {
      return $this->exceptionResponse($e);
    }
  }

  public function destroy(string $mask): JsonResponse
  {
    try {
      $article = Article::whereMask($mask)->firstOrFail();

      $article->delete();

      return $this->successResponse("Blog post deleted successfully.");
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse();
    } catch (\Exception $e) {
      return $this->exceptionResponse($e);
    }
  }

  public function comment(Request $request, string $mask)
  {
  }
}
