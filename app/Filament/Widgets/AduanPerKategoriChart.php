<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class AduanPerKategoriChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Aduan per Kategori';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $query = Kategori::query()
            ->withCount(['aduans as aduan_count' => function ($query) {
                if (Auth::user()->role === 'opd') {
                    $query->where('opd_id', Auth::user()->opd_id);
                }
            }]);

        $kategoriList = $query->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Aduan',
                    'data' => $kategoriList->pluck('aduan_count'),
                    'backgroundColor' => $this->getColorPalette($kategoriList->count()),
                ],
            ],
            'labels' => $kategoriList->pluck('nama_kategori')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // atau 'pie' kalau ingin
    }

    public static function canView(): bool
    {
        return request()->routeIs('filament.admin.pages.statistik');
    }

    private function getColorPalette(int $count): array
    {
        // Generate warna berbeda untuk tiap kategori
        $colors = [
            '#6366F1', '#10B981', '#F59E0B', '#EF4444',
            '#8B5CF6', '#EC4899', '#14B8A6', '#F97316',
            '#3B82F6', '#22C55E', '#EAB308', '#F43F5E',
            '#0EA5E9', '#A855F7', '#06B6D4', '#D946EF',
            '#84CC16', '#FB923C', '#E11D48', '#4F46E5',
            '#FCD34D', '#16A34A', '#F87171', '#818CF8',
            '#FACC15', '#059669', '#FB7185', '#7C3AED',
            '#2DD4BF', '#F472B6', '#65A30D', '#FBBF24',
            '#DC2626', '#60A5FA', '#34D399', '#FDE68A',
            '#991B1B', '#3B82F6', '#15803D', '#FFB6C1',
        ];


        // Jika jumlah kategori melebihi warna default, ulangi
        return collect($colors)->take($count)->pad($count, '#9CA3AF')->toArray();
    }
}
