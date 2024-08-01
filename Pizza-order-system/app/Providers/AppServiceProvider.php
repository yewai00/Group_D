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
        $this->app->bind('App\Contracts\Dao\CustDaoInterface', 'App\Dao\CustDao');
        $this->app->bind('App\Contracts\Dao\OrderDaoInterface', 'App\Dao\OrderDao');
        $this->app->bind('App\Contracts\Dao\CategoryDaoInterface', 'App\Dao\CategoryDao');

        // Business logic registration
        $this->app->bind('App\Contracts\Services\Rider\RiderServiceInterface', 'App\Services\Rider\RiderService');
        $this->app->bind('App\Contracts\Services\PizzaServicesInterface', 'App\Services\PizzaServices');

        $this->app->bind('App\Contracts\Services\CategoryServiceInterface', 'App\Services\CategoryService');

        $this->app->bind('App\Contracts\Services\UserServicesInterface', 'App\Services\UserServices');
        $this->app->bind('App\Contracts\Services\CustServiceInterface', 'App\Services\CustService');
        $this->app->bind('App\Contracts\Services\OrderServicesInterface', 'App\Services\OrderServices');

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
