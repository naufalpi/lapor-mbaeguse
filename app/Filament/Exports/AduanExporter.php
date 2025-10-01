<?php

namespace App\Filament\Exports;

use App\Models\Aduan;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\CellVerticalAlignment;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;

class AduanExporter extends Exporter
{
    protected static ?string $model = Aduan::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('nomor_tiket')
                ->label('Nomor Tiket'),

            ExportColumn::make('judul')
                ->label('Judul'),

            ExportColumn::make('nama')
                ->label('Pelapor'),

            ExportColumn::make('status')
                ->label('Status'),

            ExportColumn::make('opd.nama')
                ->label('OPD'),

            ExportColumn::make('ip_address')
                ->label('IP Address'),

            ExportColumn::make('created_at')
                ->label('Dibuat tanggal')
                ->formatStateUsing(fn ($state) => $state?->format('d M Y')),
        ];
    }

    public function getXlsxHeaderCellStyle(): ?Style
    {
        return (new Style())
            ->setFontBold()
            ->setFontItalic()
            ->setFontSize(14)
            ->setFontName('Consolas')
            ->setFontColor(Color::rgb(255, 255, 77))
            ->setBackgroundColor(Color::rgb(0, 0, 0))
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER);
    }

    

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your aduan export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
