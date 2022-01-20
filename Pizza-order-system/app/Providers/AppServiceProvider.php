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
        // Dao Registration
        $this->app->bind('App\Contracts\Dao\Rider\RiderDaoInterface', 'App\Dao\Rider\RiderDao');
        $this->app->bind('App\Contracts\Dao\PizzaDaoInterface', 'App\Dao\PizzaDao');
        $this->app->bind('App\Contracts\Dao\UserDaoInterface', 'App\Dao\UserDao');

        // Business logic registration
        $this->app->bind('App\Contracts\Services\Rider\RiderServiceInterface', 'App\Services\Rider\RiderService');
        $this->app->bind('App\Contracts\Services\PizzaServicesInterface', 'App\Services\PizzaServices');


        $this->app->bind('App\Contracts\Dao\CategoryDaoInterface', 'App\Dao\CategoryDao');

        $this->app->bind('App\Contracts\Services\CategoryServiceInterface', 'App\Services\CategoryService');

        $this->app->bind('App\Contracts\Services\UserServicesInterface', 'App\Services\UserServices');

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
