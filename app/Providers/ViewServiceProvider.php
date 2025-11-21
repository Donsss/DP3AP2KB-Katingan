<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;    // <-- IMPORT
use App\Models\QuickLink; // <-- IMPORT

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 'composer' akan menjalankan ini SETIAP KALI view dipanggil
        View::composer([
            'components.user-components.header', // <-- Header Anda
            'components.user-components.footer'  // <-- Footer Anda
            // (Tambahkan layout frontend utama Anda jika perlu)
        ], function ($view) {

            // 1. Ambil data settings (yang sudah digabung)
            $settings = Setting::find(1);

            // 2. Ambil data tautan cepat (yang baru)
            $quickLinks = QuickLink::orderBy('order', 'asc')->get();

            // 3. Bagikan data ini ke view
            $view->with('settings', $settings)
                 ->with('quickLinks', $quickLinks);
        });
    }
}