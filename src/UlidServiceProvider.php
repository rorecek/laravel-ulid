<?php

namespace Rorecek\Ulid;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use Rorecek\Ulid\Contracts\Factory;
=======
>>>>>>> ab4acc99edc5b1595c08a54c000364d1c566bfae

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
<<<<<<< HEAD
        $this->app->singleton(Factory::class, function ($app) {
            return new Ulid($app);
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

=======
        $this->app->singleton('ulid', function () {
            return new Ulid();
        });
    }
>>>>>>> ab4acc99edc5b1595c08a54c000364d1c566bfae
}
