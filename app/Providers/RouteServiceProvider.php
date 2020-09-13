<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


class RouteServiceProvider extends ServiceProvider
{
  /**
   * This namespace is applied to your controller routes.
   *
   * In addition, it is set as the URL generator's root namespace.
   *
   * @var string
   */
  protected $namespace = 'App\Http\Controllers';

  /**
   * The path to the "home" route for your application.
   *
   * @var string
   */
  public const HOME = '/home';

  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @return void
   */
  public function boot()
  {
    //

    parent::boot();
  }

  public function map()
  {
    $this->mapApiRoutes();

    $this->mapFakerApiRoutes();

    // $this->mapStaffApiRoutes();

    $this->mapMemberApiRoutes();

    $this->mapWebRoutes();
  }

  protected function mapWebRoutes()
  {
    foreach ($this->centralDomains() as $domain) {
      Route::middleware('web')
        ->domain($domain)
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
    }
  }

  protected function mapApiRoutes()
  {
    foreach ($this->centralDomains() as $domain) {
      Route::prefix('api')
        ->middleware('api')
        ->domain($domain)
        ->namespace($this->namespace)
        ->group(base_path('routes/api.php'));
    }
  }

  public function mapStaffApiRoutes()
  {
    Route::prefix('staff')
      ->middleware([
        InitializeTenancyByPath::class,
        PreventAccessFromCentralDomains::class
      ])
      ->namespace("App\Http\Controllers\Api\Staff")
      ->group(base_path('routes/staff.php'));
  }

  public function mapMemberApiRoutes()
  {
    foreach ($this->centralDomains() as $domain) {
      Route::prefix('member')
        ->domain($domain)
        ->middleware('api')
        ->namespace("App\Http\Controllers\Api\Member")
        ->group(base_path('routes/member.php'));
    }
  }

  public function mapFakerApiRoutes()
  {
    Route::prefix('faker')
      ->middleware("tenantApi")
      ->namespace("App\Http\Controllers\Faker")
      ->group(base_path('routes/faker.php'));
  }

  protected function centralDomains(): array
  {
    return config('tenancy.central_domains');
  }
}
