<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema; // Import Schema
use App\Models\Setting; // Import model Setting

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
        // Pengecekan ini mencegah error saat migrasi ketika tabel 'settings' belum ada.
        if (Schema::hasTable('settings')) {
            // Ambil semua data settings dari database.
            // Metode 'pluck' akan membuat array asosiatif ('key' => 'value').
            // Ini efisien karena data hanya diambil sekali per request.
            $settings = Setting::all()->pluck('value', 'key');

            // Bagikan variabel $settings ke semua view secara global.
            View::share('settings', $settings);
        }
    }
}
