<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        view()->composer('front.layouts.social-media', function ($view) {
            $view->with('socialMedia', \App\Models\AboutUs::pluck('facebook','twitter','instagram')->first());
        });

        view()->composer('front.layouts.header', function ($view) {
            $view->with('mainSliders', \App\Models\MainSlider::all());
        });
    }
}
