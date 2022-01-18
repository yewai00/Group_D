<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\Dao\PizzaDaoInterface', 'App\Dao\PizzaDao');

        $this->app->bind('App\Contracts\Services\PizzaServicesInterface', 'App\Services\PizzaServices');

        $this->app->bind('App\Contracts\Dao\CategoryDaoInterface', 'App\Dao\CategoryDao');

        $this->app->bind('App\Contracts\Services\CategoryServiceInterface', 'App\Services\CategoryService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
