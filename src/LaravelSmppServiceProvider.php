<?php

namespace Isadma\LaravelSmpp;

use Illuminate\Support\ServiceProvider;

class LaravelSmppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/smpp.php', 'smpp');

        $this->app->singleton(SmppService::class, function () {
            return new SmppService();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/smpp.php' => config_path('smpp.php'),
        ], 'config');
    }
}
