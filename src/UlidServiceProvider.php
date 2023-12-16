<?php

namespace Rorecek\Ulid;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class UlidServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blueprint::macro('ulid', function ($column = 'id') {
            return $this->char($column, 26)->unique();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Contracts\Factory::class, function ($app) {
            return new Ulid();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Factory::class];
    }

}
