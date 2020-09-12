<?php

namespace App\Providers;

use App\Observers\TenantModelObserver;
use App\Tenant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    Passport::routes(null, ["middleware" => "universal"]);
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Schema::defaultStringLength(191);
    Tenant::observe(TenantModelObserver::class);
  }
}
