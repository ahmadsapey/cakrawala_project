<?php

namespace App\Providers;

use App\Models\LandingContent;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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
        // Paksa semua URL, route, asset, dan form action selalu menggunakan HTTPS di Railway
        if (config('app.env') === 'production' || env('RAILWAY_ENVIRONMENT')) {
            URL::forceScheme('https');
        }

        // Shared view composer untuk brand content
        view()->composer([
            'components.header',
            'components.headerAdmin',
            'components.headerGuru',
            'components.headerGuru_mobile',
            'components.headerSiswa',
            'components.hiderSiswa',
            'components.footer',
            'components.footerGuru',
            'components.footerSiswa',
            'modulSiswa.login',
            'modulGuru.login',
            'modulAdmin.login',
            'maintenance.login',
        ], function (View $view): void {
            $brandContent = null;

            if (Schema::hasTable('landing_contents')) {
                $brandContent = LandingContent::query()
                    ->where('type', 'brand')
                    ->where('is_active', true)
                    ->first();
            }

            $view->with('brandContent', $brandContent);
        });
    }
}