<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\Clans;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');

          Schema::defaultStringLength(191);
          view()->composer('layout', function($view) {
               $userclan = Clans::where('userid', Auth::id())->first();
               $view->with('userclan', $userclan);
          });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
         if (env('APP_ENV') === 'production') {
            $this->app['url']->forceScheme('https');
        }
    }
}
