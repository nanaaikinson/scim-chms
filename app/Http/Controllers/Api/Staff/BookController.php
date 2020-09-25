<?php

namespace App\Http\Controllers\Api\Staff;

use App\Classes\FileManager;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLink;
use App\Models\File;
use App\Models\Image;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookController extends Controller
{
  use ResponseTrait;

  public function index()
  {
    try {
      $books = Book::all()->map(function ($book) {
        $image = $book->image;
        $file = $book->file;

        return [
          "mask" => (int)$book->mask,
          "title" => $book->title,
          "description" => $book->description ?: "",
          "created_at" => gmdate("Y-m-d", strtotime($book->created_at)),
          "cover" => $image ? (in_production() ? $image->url : url("/") . $image->url) : null,
          "file" => $file ? (in_production() ? $file->url : url("/") . $file->url) : null
        ];
      });

      return $this->dataResponse($books);
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function store(Request $request)
  {
    try {
      $rules = [
        "title" => "required",
        "file" => "required|mimes:pdf,epub|max:61440",
        "cover" => "nullable|image|mimes:jpeg,jpg,png,webp|max:2048"
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $errors = $validator->errors()->all();
        return $this->validationResponse($errors);
      }
      $slug = Str::slug(request("title"), "-");

      // Upload corresponding files
      $bookCover = null;
      $bookFile = null;
      if ($request->hasFile("cover")) {
        $bookCover = FileManager::uploadFile($request->file("cover"), "images", $slug);
      }

      if ($request->hasFile("file")) {
        $bookFile = FileManager::uploadFile($request->file("file"), "files", $slug);
      }

      // Begin Transaction
      DB::beginTransaction();
      $book = new Book();
      $book->title = $request->title;
      $book->description = $request->description ?: "";
      $book->mask = generate_mask();

      if ($book->save()) {
        if (!is_null($bookCover)) {
          $book->image()->create(["url" => $bookCover->url, "filename" => $bookCover->path, "mask" => generate_mask()]);
        }

        if (!is_null($bookFile)) {
          $book->file()->create(["url" => $bookFile->url, "filename" => $bookFile->path, "mask" => generate_mask()]);
        }

        DB::commit();
        return $this->successResponse("Book creation successful");
      }

      DB::rollBack();
      return $this->errorResponse("An error occurred while creating this book");
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function show($mask)
  {
    try {
      $book = Book::where("mask", (int)$mask)->first();
      if ($book) {
        return $this->dataResponse([
          "mask" => $book->mask,
          "title" => $book->title,
          "description" => $book->description,
          "cover" => $book->image ? (in_production() ? $book->image->url : url("/") . $book->image->url) : null,
          "file" => $book->file ? (in_production() ? $book->file->url : url("/") . $book->file->url) : null,
        ]);
      }
      return $this->notFoundResponse();
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function update(Request $request, $mask)
  {
    try {
      $book = Book::where("mask", (int)$mask)->first();
      if ($book) {
        $rules = [
          "title" => "required",
          "file" => "nullable|mimes:pdf,epub|max:61440",
          "cover" => "nullable|image|mimes:jpeg,jpg,png,webp|max:2048"
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          $errors = $validator->errors()->all();
          return $this->validationResponse($errors);
        }
        $slug = Str::slug(request("title"), "-");

        // Upload corresponding files
        $bookCover = null;
        $bookFile = null;
        if ($request->hasFile("cover")) {
          $bookCover = FileManager::uploadFile($request->file("cover"), "images", $slug);
        }

        if ($request->hasFile("file")) {
          $bookFile = FileManager::uploadFile($request->file("file"), "files", $slug);
        }

        // Begin Transaction
        DB::beginTransaction();
        $book->title = $request->title;
        $book->description = $request->description ?: "";

        if ($book->save()) {
          if (!is_null($bookCover)) {
            if ($book->image) {
              FileManager::deleteFile($book->image->filename);
              $book->image()->delete();
            }
            $book->image()->create(["url" => $bookCover->url, "filename" => $bookCover->path, "mask" => generate_mask()]);
          }

          if (!is_null($bookFile)) {
            FileManager::deleteFile($book->file->filename);
            $book->file()->delete();
            $book->file()->create(["url" => $bookFile->url, "filename" => $bookFile->path, "mask" => generate_mask()]);
          }

          DB::commit();
          return $this->successResponse("Book update successful");
        }

        DB::rollBack();
        return $this->errorResponse("An error occurred while updating this book");
      }
      return $this->notFoundResponse();
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function destroy($mask)
  {
    try {
      $book = Book::where("mask", (int)$mask)->first();
      if ($book) {
        $cover = $book->image;
        $file = $book->file;

        DB::beginTransaction();
        if ($book->delete()) {
          if ($cover) {
            Image::where("id", $cover->id)->delete();
            FileManager::deleteFile($cover->filename);
          }

          if ($file) {
            File::where("id", $file->id)->delete();
            FileManager::deleteFile($file->filename);
          }

          DB::commit();
          return $this->successResponse("Book deletion successful");
        }
        DB::rollBack();
        return $this->errorResponse("An error occurred while deleting this book");
      }
      return $this->notFoundResponse();
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function generateDownloadableLink($mask)
  {
    try {
      $book = Book::where("mask", (int)$mask)->first();
      if ($mask) {
        $token = Str::random("32");
        $url = url("/") . "/download/book/" . $token;

        $link = new BookLink();
        $link->book_id = $book->id;
        $link->mask = generate_mask();
        $link->token = $token;
        $link->url = $url;

        if ($link->save()) {
          return $this->successDataResponse("Link generation successful", ["link" => $url, "code" => $link->mask]);
        }
        return $this->errorResponse("An error occurred while generating a downloadable link for this book");
      }
      return $this->notFoundResponse();
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }

  public function download($token)
  {
    try {
      $link = BookLink::where("token", (string)$token)->first();
      if ($token) {
        $book = Book::find($link->book_id);
        $file = storage_path('app/public/' . $book->file->filename);
        return Response::download($file, Str::slug($book->title, "-"));
      }
      return $this->notFoundResponse();
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
