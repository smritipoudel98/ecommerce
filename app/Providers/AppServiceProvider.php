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
// AppServiceProvider is a file provided by Laravel that helps you:
// -Set up things before your app runs
// -Share data globally (across all pages)
// -Register services, configuration, or packages

//used appserviceprovider for following reasons.
//"Do I want this logic available across the entire app?"

//"Do I want to change some default behavior of Laravel?"

//Factory-Defines how fake data should look for your Models.
//Seeder-Inserts fake data into the database using factory
       // -It calls the factory to generate the data and then saves it