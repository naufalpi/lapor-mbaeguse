<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use App\Models\Aduan;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        // Jika superadmin, tampilkan semua data
        if ($user?->role === 'superadmin') {
            return [
                Stat::make('Aduan Menunggu', Aduan::where('status', 'Menunggu')->count()),
                Stat::make('Aduan Diproses', Aduan::where('status', 'Diproses')->count()),
                Stat::make('Aduan Selesai', Aduan::where('status', 'Selesai')->count()),
                Stat::make('Total Aduan', Aduan::count()),
            ];
        }

        // Jika OPD, filter berdasarkan opd_id
        elseif ($user?->role === 'opd') {
            return [
                Stat::make('Aduan Menunggu', Aduan::where('status', 'Menunggu')->where('opd_id', $user->opd_id)->count()),
                Stat::make('Aduan Diproses', Aduan::where('status', 'Diproses')->where('opd_id', $user->opd_id)->count()),
                Stat::make('Aduan Selesai', Aduan::where('status', 'Selesai')->where('opd_id', $user->opd_id)->count()),
                Stat::make('Total Aduan', Aduan::where('opd_id', $user->opd_id)->count()),
            ];
        }

        // Jika role tidak dikenal (atau belum login), kosongkan
        return [];
        }
}
