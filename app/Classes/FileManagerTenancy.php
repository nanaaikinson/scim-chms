<?php

namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\Storage;

class FileManagerTenancy
{
  // TODO: Set filesystem for tenant and client

  public static function uploadFile(
    object $file,
    string $folder = "uploads",
    string $name = null,
    string $type = "tenancy",
    bool $thumb = false
  )
  {
    if ($type == "tenancy") {
      return self::localTenancyUpload($file, $folder, $name);
    } else {
      return self::localCentralUpload($file, $folder, $name);
    }
  }

  public static function deleteFile(string $path, string $type = "tenancy")
  {
    if ($type == "tenancy") {
      return self::localTenancyDelete($path);
    } else {
      return self::localCentralDelete($path);
    }
  }

  public static function localTenancyUpload(object $file, string $folder = "uploads", string $name = null, bool $thumbnail = false)
  {
    try {
      $tenantId = tenant("id");
      $tenantFolder = "tenants";
      $disk = "tenant";
      $extension = $file->getClientOriginalExtension();
      $name = $name ?: md5(uniqid(mt_rand()));
      $name = $name . "-" . time();
      $filename = "{$name}.{$extension}";
      $path = "{$tenantFolder}/{$tenantId}/{$folder}/{$filename}";
      Storage::disk($disk)->put($path, (string)file_get_contents($file));
      $uploadedFile = Storage::disk($disk)->get($path);

      if ($uploadedFile) {
        $fileUrl = Storage::url($path);
        //$fileUrl = storage_path($path);
        return (object)["url" => $fileUrl, "path" => $path];
      }
      return null;
    } catch (Exception $e) {
      return null;
    }
  }

  public static function localTenancyDelete($path)
  {
    try {
      $disk = "tenant";
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

  public static function localCentralUpload(object $file, string $folder = "uploads", string $name = null, bool $thumbnail = false)
  {
    try {
      $disk = "central";
      $centralFolder = "central";
      $extension = $file->getClientOriginalExtension();
      $name = $name ?: md5(uniqid(mt_rand()));
      $name = $name . "-" . time();
      $filename = "{$name}.{$extension}";
      $path = "{$centralFolder}/{$folder}/{$filename}";
      Storage::disk($disk)->put($path, (string)file_get_contents($file));
      $uploadedFile = Storage::disk($disk)->get($path);

      if ($uploadedFile) {
        $fileUrl = Storage::url($path);
        return (object)["url" => $fileUrl, "path" => $path];
      }
      return null;
    } catch (Exception $e) {
      return null;
    }
  }

  public static function localCentralDelete($path)
  {
    try {
      $disk = "central";
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
