<?php

namespace Helilabs\HeliMenuGenerator\LaravelLogic;

use Illuminate\Support\ServiceProvider;

use Helilabs\HeliMenuGenerator\Menu;

Class HeliMenuGeneratorServiceProvider extends ServiceProvider{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'Helilabs\HeliMenuGenerator');

        $this->publishes([
            __DIR__.'/../views' => resource_path('views/vendor/helilabs/heliMenuGenerator'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Helilabs\HeliMenuGenerator', function ($app) {
            return new Menu();
        });
    }
} 