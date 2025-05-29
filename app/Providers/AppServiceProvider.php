<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;


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
        Filament::serving(function () {
            if (Auth::check()) {
                Cache::put('user-is-online-' . Auth::id(), true, now()->addMinutes(2));
                Cache::put('user-last-online-' . Auth::id(), now(), now()->addDays(1));
            }
        });

    }
}
