<?php

namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CloudinaryFileManager
{
  public static function uploadFile(
    object $file,
    string $folder = "uploads",
    string $name = null,
    bool $thumb = false
  )
  {
    if (in_production()) {
      return self::productionUpload($file, $folder, $name);
    }
    return self::localUpload($file, $folder, $name);
  }

  public static function deleteFile(string $path)
  {
    if (in_production()) {
      return self::productionDelete($path);
    }
    return self::localDelete($path);
  }

  public static function localUpload(
    object $file,
    string $folder = "uploads",
    string $name = null,
    bool $thumb = false)
  {
    try {
      $disk = config("app.env") == "production" ? "public_uploads" : "public";
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

  public static function productionUpload(
    object $file,
    string $folder = "uploads",
    string $name = null,
    bool $thumb = false)
  {
    try {
      $name .= "-" . time();
      $uploaded = $file->storeOnCloudinaryAs($folder, $name);
      return (object)["url" => $uploaded->getSecurePath(), "path" => $uploaded->getFileName(), "public_id" => $uploaded->getPublicId()];
    } catch (Exception $e) {
      return null;
    }

  }

  public static function localDelete($path)
  {
    try {
      $disk = config("app.env") == "production" ? "public_uploads" : "public";
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

  public static function productionDelete($public_id)
  {
    try {
      Artisan::call("cloudinary:delete", $public_id);
      return true;
    } catch (Exception $e) {
      return null;
    }
  }
}
