<?php

namespace App\Providers;

use App\Models\NavBarTemplate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NavBarProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if( Schema::hasTable('nav_bar_template') ){

            $nav_bars = NavBarTemplate::orderBy('order')->get()->toArray();
            View::share('nav_bars' , $nav_bars);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
