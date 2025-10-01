<?php

namespace App\Filament\Resources;

use App\Models\Opd;
use Filament\Forms;
use Filament\Tables;
use App\Models\Aduan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

use Illuminate\Support\Facades\Auth; 
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\ViewField;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\AduanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AduanResource\RelationManagers;
use App\Filament\Resources\AduanResource\RelationManagers\TanggapansRelationManager;

use App\Filament\Exports\AduanExporter;
use Filament\Tables\Actions\ExportAction;


class AduanResource extends Resource
{
    protected static ?string $model = Aduan::class;

    protected static ?string $navigationGroup = 'Kelola Aduan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Aduan';

    public static function form(Form $form): Form
    {
        return $form->schema([
          

            Section::make('Informasi Aduan')
                ->schema([
                    ViewField::make('informasi_aduan')
                        ->view('filament.resources.aduan-resource.widgets.aduan-detail'),
                ]),
            
            Section::make('Verifikasi Aduan')
                ->schema([
                    Radio::make('is_verified')
                        ->label('Status Verifikasi')
                        ->options([
                            '1' => 'Diterima',
                            '0' => 'Ditolak',
                        ])
                        ->inline()
                        ->required()
                        ->live()
                        ->afterStateUpdated(function ($state, callable $set) {
                            if ($state === '1') {
                                // Kalau diterima, bersihkan alasan penolakan
                                $set('alasan_tolak', null);
                            } else {
                                // Kalau ditolak, tetap kosong atau reset lainnya jika perlu
                                $set('alasan_tolak', '');
                            }
                        }),


                        Textarea::make('alasan_tolak')
                            ->label('Alasan Penolakan')
                            ->placeholder('Tuliskan alasan jika aduan ditolak...')
                            ->visible(fn ($get) => $get('is_verified') == '0')
                            ->required(fn ($get) => $get('is_verified') == '0')
                            ->rows(3),
                ])
                ->columns(1)
                ->visible(fn () => Auth::user()?->role === 'superadmin'),


            Section::make('Tindak Lanjut')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('status')
                                ->options([
                                    'Menunggu' => 'Menunggu',
                                    'Diproses' => 'Diproses',
                                    'Selesai' => 'Selesai',
                                ])
                                ->required()
                                ->disabled(fn ($get, $record) => $record?->is_verified != 1 || Auth::user()?->role !== 'superadmin'),
                    

                            Select::make('opd_id')
                                ->label('OPD Penanggung Jawab')
                                ->options(\App\Models\Opd::pluck('nama', 'id'))
                                ->searchable()
                                ->disabled(fn ($get, $record) => $record?->is_verified != 1 || Auth::user()?->role !== 'superadmin')

                    

                            
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_tiket')
                    ->label('Nomor Tiket')
                    ->sortable()
                    ->searchable()
                    ->toggleable(), // bisa di-hide/show

                TextColumn::make('judul')
                    ->sortable()
                    ->searchable()
                    ->limit(20)
                    ->toggleable(),

                TextColumn::make('nama')
                    ->label('Pelapor')
                    ->searchable()
                    ->limit(15)
                    ->toggleable(),

                TextColumn::make('status')  
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->colors([
                        'danger' => 'Menunggu',
                        'warning' => 'Diproses',
                        'success' => 'Selesai',
                    ])
                    ->toggleable(),

                TextColumn::make('opd.nama')
                    ->searchable()
                    ->label('OPD')
                    ->limit(15)
                    ->toggleable(),

                TextColumn::make('ip_address')   // 👈 Tambahan kolom IP
                    ->label('IP Address')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true), 
                    // default disembunyikan, tapi bisa diaktifkan lewat menu

                TextColumn::make('created_at')
                    ->label('Dibuat tanggal')
                    ->searchable()
                    ->sortable()
                    ->dateTime('d M Y')
                    ->toggleable(),

                ToggleColumn::make('is_visible')
                    ->label('Tampilkan')
                    ->onIcon('heroicon-o-eye')
                    ->offIcon('heroicon-o-eye-slash')
                    ->onColor('success')
                    ->offColor('danger')
                    ->visible(fn () => Auth::user()?->role === 'superadmin')
                    ->toggleable(),
            ])

            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(AduanExporter::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TanggapansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAduans::route('/'),
            'edit' => Pages\EditAduan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        // Jika user adalah admin opd, filter aduan berdasarkan opd_id
        if (Auth::check() && Auth::user()->role === 'opd') {
            $query->where('opd_id', Auth::user()->opd_id);
        }

        return $query;
    }

    public static function getNavigationBadge(): ?string
    {
        $user = Auth::user();

       
        if ($user?->role === 'superadmin') {
        // Superadmin: hitung semua aduan dengan status 'Menunggu'
        $count = Aduan::where('status', 'Menunggu')->count();
        } elseif ($user?->role === 'opd') {
            // OPD: hitung aduan dengan status 'Menunggu' atau 'Diproses' sesuai opd_id
            $count = Aduan::whereIn('status', ['Menunggu', 'Diproses'])
                ->where('opd_id', $user->opd_id)
                ->count();
        } else {
            $count = 0;
        }

        return $count > 0 ? (string) $count : null;
    }


    public static function getNavigationBadgeColor(): string | array | null
    {
        return 'danger'; // Warna merah
    }

    




}
