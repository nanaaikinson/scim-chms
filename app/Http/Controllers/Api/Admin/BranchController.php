<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchStoreRequest;
use App\Models\Branch;
use App\Tenant;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Support\Str;
use Laravel\Passport\Client as PassportClient;
use Laravel\Passport\PersonalAccessClient as PassportPersonalAccessClient;

class BranchController extends Controller
{
  use ResponseTrait;

  public function store(BranchStoreRequest $request)
  {
    try {
      $validated = (object)$request->validationData();
      $branch = Branch::create([
        "name" => $validated->name,
        "subdomain" => $validated->subdomain,
        "mask" => generate_mask()
      ]);

      if ($branch) {
        $tenant = Tenant::create(["id" => strtolower($branch->subdomain)]);
        $tenant->domains()->create(["domain" => strtolower($branch->subdomain) . "." . getenv("TENANT_DOMAIN")]);
        $tenant->run(function () use ($tenant) {
          PassportClient::create([
            "name" => ucfirst($tenant->id) . " Personal Access Client",
            "secret" => Str::random(40),
            "redirect" => "http://{$tenant->id}." . getenv("TENANT_DOMAIN"),
            "personal_access_client" => 1,
            "password_client" => 0,
            "revoked" => 0
          ]);

          PassportPersonalAccessClient::create(["client_id" => 1]);

          //Artisan::call("passport:keys");
          //Artisan::call("tenants:seed", ["--tenants" => $tenant->id]);
        });

        dd($tenant);
      }

    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
