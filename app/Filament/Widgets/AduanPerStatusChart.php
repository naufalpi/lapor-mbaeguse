<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Aduan;
use Illuminate\Support\Facades\Auth;

class AduanPerStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Aduan per Status';
    protected static ?string $maxHeight = '270px';
    

    protected function getData(): array
    {

        $user = Auth::user();

        $query = Aduan::query();

        if ($user->role === 'opd') {
            $query->where('opd_id', $user->opd_id);
        }

        $statuses = ['Menunggu', 'Diproses', 'Selesai'];

        $data = collect($statuses)->map(function ($status) use ($query) {
            return $query->clone()->where('status', $status)->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Aduan',
                    'data' => $data,
                    'backgroundColor' => ['#f85656', '#facc15', '#4ade80'], // warna opsional
                ],
            ],
            'labels' => $statuses,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut'; // bisa juga 'pie'
    }

    // Agar hanya tampil di halaman Statistik
    public static function canView(): bool
    {
        return request()->routeIs('filament.admin.pages.statistik');
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => ['display' => false],
                'y' => ['display' => false],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
        ];
    }



}
