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

class LaporanExporter extends Exporter
{
    protected static ?string $model = Aduan::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('nomor_tiket')
                ->label('No. Tiket'),

            ExportColumn::make('opd.nama')
                ->label('OPD'),

            ExportColumn::make('kategoris.nama_kategori')
                ->label('Kategori')
                ->state(fn ($record) => $record->kategoris->pluck('nama_kategori')->implode(', ')),

            ExportColumn::make('created_at')
                ->label('Tanggal Dibuat')
                ->formatStateUsing(fn ($state) => $state?->format('d M Y H:i')),

            ExportColumn::make('waktu_verifikasi')
                ->label('Waktu Verifikasi')
                ->state(fn ($record) => static::formatDiff(
                    $record->created_at,
                    $record->riwayats->firstWhere('status', 'Diverifikasi')?->created_at
                )),

            ExportColumn::make('waktu_diteruskan')
                ->label('Waktu Diteruskan')
                ->state(fn ($record) => static::formatDiff(
                    $record->riwayats->firstWhere('status', 'Diverifikasi')?->created_at,
                    $record->riwayats->firstWhere('status', 'Diteruskan')?->updated_at
                )),

            ExportColumn::make('waktu_ditanggapi')
                ->label('Waktu Ditanggapi')
                ->state(fn ($record) => static::formatDiff(
                    $record->riwayats->firstWhere('status', 'Diteruskan')?->created_at,
                    $record->riwayats->firstWhere('status', 'Ditanggapi')?->created_at
                )),

            ExportColumn::make('waktu_diselesaikan')
                ->label('Waktu Diselesaikan')
                ->state(fn ($record) => static::formatDiff(
                    $record->riwayats->firstWhere('status', 'Ditanggapi')?->created_at,
                    $record->riwayats->firstWhere('status', 'Diselesaikan')?->created_at
                )),

            ExportColumn::make('total_waktu')
                ->label('Total Waktu')
                ->state(fn ($record) => static::formatDiff(
                    $record->created_at,
                    $record->riwayats->firstWhere('status', 'Diselesaikan')?->created_at
                )),
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

    public static function getCompletedNotificationBody($export): string
    {
        return 'Ekspor laporan aduan sudah selesai dan siap diunduh. ' . number_format($export->successful_rows) . ' ' . str('baris')->plural($export->successful_rows) . ' berhasil diekspor.';
    }

    protected static function formatDiff($from, $to): ?string
    {
        if (! $from || ! $to) {
            return null;
        }

        return $from->diffForHumans($to, [
            'parts' => 3,
            'short' => true,
        ]);
    }
}
