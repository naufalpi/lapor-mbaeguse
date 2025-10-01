<?php

namespace App\Providers;

use App\Models\Opd;
use App\Models\User;
use App\Models\Aduan;
use App\Models\Kategori;
use App\Models\Tanggapan;
use Filament\Facades\Filament;
use App\Observers\AduanObserver;
use App\Observers\GenericObserver;
use App\Observers\TanggapanObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

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

        User::observe(GenericObserver::class);
        Opd::observe(GenericObserver::class);
        Kategori::observe(GenericObserver::class);
        Aduan::observe(AduanObserver::class);
        Tanggapan::observe(TanggapanObserver::class);

        Filament::serving(function () {
            if (Auth::check()) {
                Cache::put('user-is-online-' . Auth::id(), true, now()->addMinutes(2));
                Cache::put('user-last-online-' . Auth::id(), now(), now()->addDays(1));
            }
        });

    }
}
