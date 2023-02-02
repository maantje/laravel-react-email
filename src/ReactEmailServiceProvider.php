<?php

namespace Maantje\ReactEmail;

use Illuminate\Support\ServiceProvider;

class ReactEmailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/react-email.php' => config_path('react-email.php'),
        ]);
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/react-email.php', 'react-email'
        );
    }
}
