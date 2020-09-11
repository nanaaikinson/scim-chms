<?php

namespace App\Providers;

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
    /*if ($this->app->environment() == 'production') {
      \URL::forceScheme('https');
      \URL::forceRootUrl(\Config::get('app.url'));
    }*/
  }
}
