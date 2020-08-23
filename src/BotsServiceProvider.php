<?php

namespace Harishariyanto\Bots;

use Illuminate\Support\ServiceProvider;

class BotsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../publishes/app'       => app_path(),
            __DIR__ . '/../publishes/database'  => database_path(),
            __DIR__ . '/../publishes/stubs'     => resource_path('stubs')
        ]);
    }
}
