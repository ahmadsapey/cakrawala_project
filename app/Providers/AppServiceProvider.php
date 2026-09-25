<?php

namespace App\Providers;

use App\Models\LandingContent;
use Illuminate\Support\Facades\Schema;
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
            $brandContent = Schema::hasTable('landing_contents')
                ? LandingContent::query()->where('type', 'brand')->where('is_active', true)->first()
                : null;

            $view->with('brandContent', $brandContent);
        });
    }
}
