<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ProductType;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('header',function($view){
            $product_type = ProductType::all();
            $view->with('product_type',$product_type);
        });
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
