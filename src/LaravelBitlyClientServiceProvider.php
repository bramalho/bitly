<?php

namespace BRamalho\LaravelBitlyClient;

use Illuminate\Support\ServiceProvider;

class LaravelBitlyClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/bitly.php' => config_path('bitly.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
