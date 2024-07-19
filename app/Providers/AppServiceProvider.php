<?php

namespace App\Providers;

use App\Repositories\CategoryProductRepository;
use App\Repositories\Contracts\CategoryProductRepositoryInterface;
use App\Services\CategoryProductService;
use App\Services\Contracts\CategoryProductServiceInterface;
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
        $this->app->singleton(CategoryProductRepositoryInterface::class, CategoryProductRepository::class);
        $this->app->singleton(CategoryProductServiceInterface::class, CategoryProductService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
