<?php

namespace Rorecek\Ulid;

use Illuminate\Support\ServiceProvider;

class UlidServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ulid', function () {
            return new Ulid();
        });
    }
}
