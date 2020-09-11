<?php

namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileManager
{
  public static function uploadFile(
    object $file,
    string $folder = "uploads",
    string $name = null,
    bool $thumb = false
  )
  {
    return self::localUpload($file, $folder, $name);
  }

  public static function deleteFile(string $path)
  {
    return self::localDelete($path);
  }

  public static function localUpload(object $file, string $folder = "uploads",string $name = null, bool $thumb = false)
  {
    try {
      //$disk = config("app.env") == "production" ? "public_uploads" : "public";
      $disk = "public";
      $extension = $file->getClientOriginalExtension();
      $name = $name ?: md5(uniqid(mt_rand()));
      $name = $name . "-" . time();
      $filename = "{$name}.{$extension}";
      $path = "{$folder}/{$filename}";
      Storage::disk($disk)->put($path, (string)file_get_contents($file));
      $uploadedFile = Storage::disk($disk)->get($path);

      if ($uploadedFile) {
        $fileUrl = config("app.env") == "production" ? url("uploads/" . $path) : Storage::url($path);
        return (object)["url" => $fileUrl, "path" => $path];
      }
      return null;
    } catch (Exception $e) {
      return null;
    }
  }

  public static function localDelete($path)
  {
    try {
      //$disk = config("app.env") == "production" ? "public_uploads" : "public";
      $disk = "public";
      $file = Storage::disk($disk)->get($path);

      if ($file) {
        Storage::disk($disk)->delete($path);
        $exists = Storage::disk($disk)->exists($path);

        if (!$exists) {
          return true;
        }
        return null;
      }

      return null;
    } catch (Exception $e) {
      return null;
    }
  }

}
