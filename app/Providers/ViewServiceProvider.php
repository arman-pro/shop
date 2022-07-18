<?php

namespace App\Providers;

use App\Http\View\Composer\NameComposer;
use Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('name', NameComposer::class);
        View::composer('layout.app', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
            $view->with('cartItems', Cart::getContent());
        });
    }
}
