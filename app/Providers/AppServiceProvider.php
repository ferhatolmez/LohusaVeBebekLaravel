<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

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

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        View::share('clinicalDefaults', [
            'lohusa' => [
                'gebelik_kilosu' => 70,
                'mevcut_kilo' => 65,
                'ates' => 36.6,
                'nabiz' => 80,
                'solunum' => 16,
                'tansiyon' => '120/80',
                'hemoglobin' => 12,
            ],
            'bebek' => [
                'kac_haftalik' => 40,
                'izlem_sayisi' => 1,
                'ates' => 36.5,
                'nabiz' => 120,
                'solunum' => 40,
                'kilo' => 3.2,
                'boy' => 50,
                'bas_cevresi' => 34,
                'gogus_cevresi' => 32,
            ],
        ]);
    }
}
