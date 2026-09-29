<?php

namespace Rapidez\Account;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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
        $this->loadRoutesFrom(__DIR__.'/../routes/magento-redirects.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'rapidez');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/rapidez'),
        ], 'views');

        Blade::componentNamespace('Rapidez\\Account\\View\\Components', 'rapidez');
        ViewFacade::composer('rapidez::layouts.app', function (View $view) {
            $view->getFactory()->startPush('page_end', view('rapidez::account.partials.login-expire')->render());
        });
    }

    protected function bootTranslations(): self
    {
        $this->loadJsonTranslationsFrom(__DIR__.'/../lang');

        return $this;
    }
}
