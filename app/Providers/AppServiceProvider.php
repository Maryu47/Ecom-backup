<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use App\Models\LogoSettings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
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

        $generalSetting = GeneralSetting::first();
        $logoSetting = LogoSettings::first();
        //set time zone
        Config::set('app.timezone', $generalSetting->time_zone);
        //share variable at all view
        View::composer('*', function($view) use ($generalSetting, $logoSetting){
            $view->with(['settings'=> $generalSetting, 'logoSetting' => $logoSetting]);
        });
    }
}
