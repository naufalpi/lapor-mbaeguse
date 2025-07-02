<?php

namespace App\Filament\Widgets;

use App\Models\Opd;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class AduanPerOpdChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Aduan per OPD';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $opds = Opd::withCount('aduans')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Aduan',
                    'data' => $opds->pluck('aduans_count'),
                ],
            ],
            'labels' => $opds->pluck('nama'), // atau 'nama_opd' sesuai field-nya
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
    
   public static function canView(): bool
{
    return request()->routeIs('filament.admin.pages.statistik')
        && Auth::user()?->role === 'superadmin';
}

}
