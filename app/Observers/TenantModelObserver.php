<?php

namespace App\Observers;

use App\Tenant;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TenantModelObserver
{
  public function creating(Tenant $tenant)
  {
    /*File::makeDirectory(storage_path("tenant{$tenant->id}/app/public"), 0755, true);
    File::makeDirectory(storage_path("tenant{$tenant->id}/logs"), 0755, true);
    $gitignore = fopen(storage_path("tenant{$tenant->id}/.gitignore"), "w");
    fwrite($gitignore, "*");

    File::copy(storage_path("oauth-private.key"), storage_path("tenant{$tenant->id}/oauth-private.key"));
    File::copy(storage_path("oauth-public.key"), storage_path("tenant{$tenant->id}/oauth-public.key"));*/
  }

  public function created(Tenant $tenant)
  {
  }

  public function updated(Tenant $tenant)
  {
  }

  public function deleted(Tenant $tenant)
  {
  }

  public function restored(Tenant $tenant)
  {
  }

  public function forceDeleted(Tenant $tenant)
  {
    Storage::delete("tenant{$tenant->id}");
  }
}
