<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchStoreRequest;
use App\Models\Branch;
use App\Tenant;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Laravel\Passport\Client as PassportClient;
use Laravel\Passport\PersonalAccessClient as PassportPersonalAccessClient;
use Exception;

class BranchController extends Controller
{
  use ResponseTrait;

  public function store(BranchStoreRequest $request)
  {
    try {
      $validated = (object)$request->validationData();
      $branch = new Branch();
      $branch->name = $validated->name;
      $branch->subdomain = $validated->subdomain;
      $branch->mask = generate_mask();

      if ($branch->save()) {
        $domain = strtolower($branch->subdomain) . "." . getenv("TENANT_DOMAIN");
        $tenant = Tenant::create(["id" => strtolower($branch->subdomain)]);
        $tenant->domains()->create(["domain" => $domain]);
        $tenant->run(function () use ($tenant) {

          // Save passport client
          PassportClient::create([
            "name" => ucfirst($tenant->id) . " Personal Access Client",
            "secret" => Str::random(40),
            "redirect" => "http://{$tenant->id}." . getenv("TENANT_DOMAIN"),
            "personal_access_client" => 1,
            "password_client" => 0,
            "revoked" => 0
          ]);

          // Save passport personal access client
          PassportPersonalAccessClient::create(["client_id" => 1]);

          Artisan::call("tenants:seed", ["--tenants" => $tenant->id]);
        });

        if ($tenant) {
          $branch->tenant_id = $tenant->id;
          $branch->domain = $domain;
          $branch->save();

          return $this->successResponse("Branch created successfully.");
        }
        return $this->errorResponse("An error occurred while creating this branch");
      }
      return $this->errorResponse("An error occurred while saving this branch");
    }
    catch (Exception $e) {
      return $this->errorResponse($e->getMessage());
    }
  }
}
