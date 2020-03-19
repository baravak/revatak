<?php

namespace App\Providers;

use App\Http\Middleware\WebResponse;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('web', WebResponse::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
