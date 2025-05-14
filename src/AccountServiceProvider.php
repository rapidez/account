<?php

namespace Rapidez\Account;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootTranslations();

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'rapidez');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/rapidez'),
        ], 'views');

        Blade::componentNamespace('Rapidez\\Account\\View\\Components', 'rapidez');
    }

    protected function bootTranslations(): self
    {
        $this->loadJsonTranslationsFrom(__DIR__.'/../lang');

        return $this;
    }
}
