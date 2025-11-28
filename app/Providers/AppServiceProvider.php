<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(
            [
                'components.user-components.layout',
                'components.user-components.header',
                'components.user-components.footer',
                'layouts.app',
                'layouts.guest',
            ], 
            function ($view) {
                static $settings = null;
                
                if (is_null($settings)) {
                    $settings = Setting::firstOrCreate(['id' => 1]);
                }
                $view->with('settings', $settings);
            }
        );
        Paginator::useBootstrapFive();
    }
}
