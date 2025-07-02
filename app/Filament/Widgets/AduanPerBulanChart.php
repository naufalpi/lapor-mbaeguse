<?php

namespace App\Filament\Widgets;

use App\Models\Aduan;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AduanPerBulanChart extends ChartWidget
{
    protected static ?string $heading = 'Aduan per Bulan';

    protected static ?string $maxHeight = '270px';

    // protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $user = Auth::user();

        $query = Aduan::query();

        if ($user->role === 'opd') {
            $query->where('opd_id', $user->opd_id);
        }

        $data = $query->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = collect(range(1, 12))->map(function ($month) {
            return now()->setMonth($month)->translatedFormat('F'); // Nama bulan full
        });

        $counts = $labels->keys()->map(function ($i) use ($data) {
            $month = $i + 1;
            return $data->firstWhere('month', $month)->count ?? 0;
        });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Aduan',
                    'data' => $counts,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)', // Blue-500 transparan
                    'borderColor' => 'rgba(59, 130, 246, 1)', // Blue-500
                    'borderWidth' => 2,
                    'fill' => true,
                    'tension' => 0.3, // garis melengkung
                    'pointBackgroundColor' => '#2563EB',
                    'pointBorderColor' => '#fff',
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }


    protected function getType(): string
    {
        return 'bar'; // Bisa 'line' atau 'bar'
    }

    public static function canView(): bool
    {
        return request()->routeIs('filament.admin.pages.statistik');
    }
}
