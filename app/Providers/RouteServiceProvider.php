<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

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

  /**
   * Define the routes for the application.
   *
   * @return void
   */
  public function map()
  {
    $this->mapApiRoutes();

    $this->mapFakerApiRoutes();

    $this->mapStaffApiRoutes();

    $this->mapMemberApiRoutes();

    $this->mapWebRoutes();
  }

  /**
   * Define the "web" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapWebRoutes()
  {
    foreach ($this->centralDomains() as $domain) {
      Route::middleware('web')
        ->domain($domain)
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
    }
  }

  /**
   * Define the "api" routes for the application.
   *
   * These routes are typically stateless.
   *
   * @return void
   */
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
      ->middleware('api')
      ->namespace("App\Http\Controllers\Api\Staff")
      ->group(base_path('routes/api/staff.php'));
  }

  public function mapMemberApiRoutes()
  {
    Route::prefix('member')
      ->middleware('api')
      ->namespace("App\Http\Controllers\Api\Member")
      ->group(base_path('routes/api/member.php'));
  }

  public function mapFakerApiRoutes()
  {
    Route::prefix('faker')
      ->middleware('api')
      ->namespace("App\Http\Controllers\Faker")
      ->group(base_path('routes/api/faker.php'));
  }

  protected function centralDomains(): array
  {
    return config('tenancy.central_domains');
  }
}
