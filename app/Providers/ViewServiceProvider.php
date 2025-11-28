<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;    
use App\Models\QuickLink;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer([
            'components.user-components.header',
            'components.user-components.footer'
        ], function ($view) {
            $settings = Setting::find(1);

            $quickLinks = QuickLink::orderBy('order', 'asc')->get();
            
            $view->with('settings', $settings)
                 ->with('quickLinks', $quickLinks);
        });
    }
}