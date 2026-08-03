<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.modern');

        try {
            if (\Schema::hasTable('app_settings')) {
                $appSettings = \App\Models\AppSetting::firstOrCreate([]);
                \View::share('appSettings', $appSettings);
            }
        } catch (\Exception $e) {
            // Silence exceptions during migration/setup
        }
    }
}
