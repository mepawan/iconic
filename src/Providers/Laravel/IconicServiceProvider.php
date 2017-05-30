<?php

namespace Marquine\Iconic\Providers\Laravel;

use Marquine\Iconic\Icon;
use Marquine\Iconic\Repository;
use Illuminate\Support\ServiceProvider;

class IconicServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/iconic.php' => config_path('iconic.php'),
        ], 'iconic');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Icon::class, function ($app) {
            return new Icon(new Repository, $app['config']['iconic']);
        });

        icon($this->app->make(Icon::class));
    }
}