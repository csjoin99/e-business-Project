<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Settings;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['web.*'], function ($view) {
            $settings = Settings::get()->first();
            $global_product_categories = Category::get();
            $view->with(compact('settings', 'global_product_categories'));
        });
    }
}
