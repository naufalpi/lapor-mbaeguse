<?php

namespace App\Filament\Widgets;

use App\Models\Aduan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LaporanAduanStats extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $aduans = Aduan::where('is_verified', 1)
            ->with('riwayats')
            ->get();

        $durations = $aduans->map(function ($aduan) {
            $verifikasi   = $aduan->riwayats->firstWhere('status', 'Diverifikasi')?->created_at;
            $diteruskan   = $aduan->riwayats->firstWhere('status', 'Diteruskan')?->created_at;
            $ditanggapi   = $aduan->riwayats->firstWhere('status', 'Ditanggapi')?->created_at;
            $diselesaikan = $aduan->riwayats->firstWhere('status', 'Diselesaikan')?->created_at;

            return [
                'verifikasi'   => ($verifikasi && $aduan->created_at) ? $aduan->created_at->diffInMinutes($verifikasi) : null,
                'diteruskan'   => ($verifikasi && $diteruskan) ? $verifikasi->diffInMinutes($diteruskan) : null,
                'ditanggapi'   => ($diteruskan && $ditanggapi) ? $diteruskan->diffInMinutes($ditanggapi) : null,
                'diselesaikan' => ($ditanggapi && $diselesaikan) ? $ditanggapi->diffInMinutes($diselesaikan) : null,
                'total'        => ($aduan->created_at && $diselesaikan) ? $aduan->created_at->diffInMinutes($diselesaikan) : null,
            ];
        });

        $avgVerifikasi   = $durations->pluck('verifikasi')->filter()->avg();
        $avgDiteruskan   = $durations->pluck('diteruskan')->filter()->avg();
        $avgDitanggapi   = $durations->pluck('ditanggapi')->filter()->avg();
        $avgDiselesaikan = $durations->pluck('diselesaikan')->filter()->avg();
        $avgTotal        = $durations->pluck('total')->filter()->avg();

        return [
            Stat::make('Rata-rata Verifikasi', $this->formatMinutes($avgVerifikasi))
                ->description('Waktu dari aduan masuk → diverifikasi')
                ->descriptionIcon('heroicon-o-clock')
                ->color('info'),

            Stat::make('Rata-rata Diteruskan', $this->formatMinutes($avgDiteruskan))
                ->description('Waktu dari diverifikasi → diteruskan')
                ->descriptionIcon('heroicon-o-arrow-right-circle')
                ->color('warning'),

            Stat::make('Rata-rata Ditanggapi', $this->formatMinutes($avgDitanggapi))
                ->description('Waktu dari diteruskan → ditanggapi')
                ->descriptionIcon('heroicon-o-chat-bubble-bottom-center-text')
                ->color('success'),

            Stat::make('Rata-rata Diselesaikan', $this->formatMinutes($avgDiselesaikan))
                ->description('Waktu dari ditanggapi → diselesaikan')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('emerald'),

            Stat::make('Rata-rata Total', $this->formatMinutes($avgTotal))
                ->description('Total waktu dari aduan masuk → selesai')
                ->descriptionIcon('heroicon-o-flag')
                ->color('primary'),
        ];
    }

    private function formatMinutes(?float $minutes): string
    {
        if (is_null($minutes)) {
            return '-';
        }

        $minutes = (int) round($minutes);

        $days  = floor($minutes / 1440);
        $hours = floor(($minutes % 1440) / 60);
        $mins  = $minutes % 60;

        $parts = [];
        if ($days > 0)  $parts[] = $days . ' hari';
        if ($hours > 0) $parts[] = $hours . ' jam';
        if ($mins > 0)  $parts[] = $mins . ' menit';

        return implode("\n", $parts);
    }

    public static function canView(): bool
    {
        // hanya muncul kalau sedang di halaman laporan
        return request()->routeIs('filament.pages.laporan-aduan');
    }
}
