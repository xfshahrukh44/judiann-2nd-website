<?php

namespace App\Providers;

use App\Models\Settings;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        view()->composer('*', function ($view) {
            $cart_count = Cart::count();
            $setting = Settings::find(1);
            $view->with('setting', $setting);
            $view->with('cart_count', $cart_count ?? 0);
        });
    }
}
