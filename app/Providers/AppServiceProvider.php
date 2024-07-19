<?php

namespace App\Providers;

use App\Repositories\CategoryProductRepository;
use App\Repositories\Contracts\CategoryProductRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Services\CategoryProductService;
use App\Services\Contracts\CategoryProductServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\ProductService;
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
        $this->app->singleton(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->singleton(ProductServiceInterface::class, ProductService::class);
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
