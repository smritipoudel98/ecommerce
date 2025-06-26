<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

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
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $cartCount = Cart::where('user_id', Auth::id())->count();
                $view->with('cartCount', $cartCount);
            } else {
                $view->with('cartCount', 0);
            }
        });
    }
}