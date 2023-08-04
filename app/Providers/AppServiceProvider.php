<?php

namespace App\Providers;

use App\Models\ManagePesanan;
use App\Observers\ManagePesananObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        //
        config(['app.locale' => 'id']);
        \Carbon\Carbon::setLocale('id');

        Paginator::useBootstrap();

        ManagePesanan::observe(ManagePesananObserver::class);

        // if ((env('APP_ENV')) !== 'local') {
        //     URL::forceScheme('https');
        // }
    }
}
