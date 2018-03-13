<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot ()
    {
        // pass current route name to sidebar
        /*view()->composer('sidebar', function ($view) {
            $current_route_name = \Request::route()->getName();
            $view->with('current_route_name', $current_route_name);
        });*/

        // pass list of queues to sidebar
        view()->composer('sidebar', function ($view) {
            $queues = \App\Queue::orderBy('name')->get();
            $view->with('queues', $queues);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
