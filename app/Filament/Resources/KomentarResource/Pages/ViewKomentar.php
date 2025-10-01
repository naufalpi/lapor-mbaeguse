<?php

namespace App\Filament\Resources\KomentarResource\Pages;

use App\Filament\Resources\KomentarResource;
use Filament\Resources\Pages\ViewRecord;

class ViewKomentar extends ViewRecord
{
    protected static string $resource = KomentarResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\KomentarResource\Widgets\AduanDetailWidget::class,
            \App\Filament\Resources\KomentarResource\Widgets\KomentarListWidget::class,
        ];
    }
}
