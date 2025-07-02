<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\AduanPerOpdChart;
use App\Filament\Widgets\AduanPerBulanChart;
use App\Filament\Widgets\AduanPerStatusChart;
use App\Filament\Widgets\AduanPerKategoriChart;

class Statistik extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.statistik';
    protected static ?string $navigationGroup = 'Statistik';
    protected static ?string $navigationLabel = 'Statistik Aduan';
    protected static ?int $navigationSort = 1000;

    public function getHeaderWidgets(): array
    {
        return [
            AduanPerBulanChart::class,
            AduanPerStatusChart::class,
            AduanPerKategoriChart::class,
            AduanPerOpdChart::class,
        ];
    }
}
