<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use Filament\Tables;
use App\Models\Aduan;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use App\Filament\Exports\AduanExporter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColumnGroup;
use App\Filament\Exports\LaporanExporter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\Exports\Models\Export;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Filters\DatePickerFilter;
use Filament\Actions\Exports\Enums\ExportFormat;


class LaporanAduan extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $navigationGroup = 'Statistik';
    protected static ?string $navigationLabel = 'Laporan Aduan';
    protected static ?int $navigationSort = 998;

    protected static string $view = 'filament.pages.laporan-aduan';

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && in_array($user->role, [
            'superadmin',
            'bupati',
            'wabup',
            'sekda',
        ]);
    }

    private function formatDiff($start, $end): string
    {
        if (! $start || ! $end) {
            return '-';
        }

        $diff = $start->diff($end);

        $parts = [];
        if ($diff->d > 0) $parts[] = $diff->d . ' h';
        if ($diff->h > 0) $parts[] = $diff->h . ' j';
        if ($diff->i > 0) $parts[] = $diff->i . ' m';
        if ($diff->s > 0 && empty($parts)) $parts[] = $diff->s . ' detik';

        return implode(' ', $parts);
    }

    public function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\LaporanAduanStats::class,
        ];
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(
                Aduan::query()
                    ->where('is_verified', 1)
                    ->with(['riwayats', 'opd', 'kategoris'])
            )
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('nomor_tiket')
                    ->label('No. Tiket')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('opd.nama')
                    ->label('OPD')
                    ->sortable()
                    ->searchable()
                    ->limit(15)
                    ->toggleable(),
                TextColumn::make('kategoris')
                    ->label('Kategori')
                    ->getStateUsing(fn ($record) => $record->kategoris->pluck('nama_kategori')->implode('<br>'))
                    ->html()
                    ->sortable()
                    ->toggleable(), 
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),

                ColumnGroup::make('Waktu', [
                    TextColumn::make('waktu_verifikasi')
                        ->label('Verifikasi')
                        ->getStateUsing(fn ($record) => $this->formatDiff(
                            $record->created_at,
                            $record->riwayats->firstWhere('status', 'Diverifikasi')?->created_at
                        ))
                        ->toggleable(),

                    TextColumn::make('waktu_diteruskan')
                        ->label('Diteruskan')
                        ->getStateUsing(fn ($record) => $this->formatDiff(
                            $record->riwayats->firstWhere('status', 'Diverifikasi')?->created_at,
                            $record->riwayats->firstWhere('status', 'Diteruskan')?->updated_at
                        ))
                        ->toggleable(),

                    TextColumn::make('waktu_ditanggapi')
                        ->label('Ditanggapi')
                        ->getStateUsing(fn ($record) => $this->formatDiff(
                            $record->riwayats->firstWhere('status', 'Diteruskan')?->created_at,
                            $record->riwayats->firstWhere('status', 'Ditanggapi')?->created_at
                        ))
                        ->toggleable(),

                    TextColumn::make('waktu_diselesaikan')
                        ->label('Diselesaikan')
                        ->getStateUsing(fn ($record) => $this->formatDiff(
                            $record->riwayats->firstWhere('status', 'Ditanggapi')?->created_at,
                            $record->riwayats->firstWhere('status', 'Diselesaikan')?->created_at
                        ))
                        ->toggleable(),

                    TextColumn::make('total_waktu')
                        ->label('Total')
                        ->getStateUsing(fn ($record) => $this->formatDiff(
                            $record->created_at,
                            $record->riwayats->firstWhere('status', 'Diselesaikan')?->created_at
                        ))
                        ->sortable()
                        ->toggleable(),
                ])->alignCenter(),
                ])
      
                ->headerActions([
                    ExportAction::make()
                        ->exporter(LaporanExporter::class)
                        ->formats([
                            ExportFormat::Xlsx,
                        ]),

                ])
                ->bulkActions([
                    ExportBulkAction::make()
                        ->exporter(LaporanExporter::class)
                ])
                ->filters([
                    // Filter Waktu
                    SelectFilter::make('tanggal')
                        ->form([
                            DatePicker::make('from')->label('Dari tanggal'),
                            DatePicker::make('to')->label('Sampai tanggal'),
                        ])
                        ->query(function (Builder $query, array $data) {
                            return $query
                                ->when($data['from'] ?? null, fn($q, $from) => $q->whereDate('created_at', '>=', $from))
                                ->when($data['to'] ?? null, fn($q, $to) => $q->whereDate('created_at', '<=', $to));
                        }),

                    // Filter OPD
                    SelectFilter::make('opd')
                        ->label('OPD')
                        ->relationship('opd', 'nama'),

                    // Filter Kategori
                    SelectFilter::make('kategori')
                        ->label('Kategori')
                        ->relationship('kategoris', 'nama_kategori'),
                ]);

           
    }
}
