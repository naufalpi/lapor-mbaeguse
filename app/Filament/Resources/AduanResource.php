<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AduanResource\Pages;
use App\Filament\Resources\AduanResource\RelationManagers;
use App\Filament\Resources\AduanResource\RelationManagers\TanggapansRelationManager;
use App\Models\Aduan;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;

use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\ToggleColumn;


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
                    Grid::make(2)
                        ->schema([
                            Group::make([
                                Placeholder::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->content(fn ($record) => $record->created_at
                                        ? $record->created_at->timezone('Asia/Jakarta')->format('d M Y H:i')
                                        : '-')
                                    ->extraAttributes(['class' => 'font-semibold text-gray-700']),

                                Placeholder::make('nomor_tiket')
                                    ->label('No. Tiket')
                                    ->content(fn ($record) => $record->nomor_tiket),

                                Placeholder::make('judul')
                                    ->label('Judul')
                                    ->content(fn ($record) => $record->judul),

                                Placeholder::make('isi')
                                    ->label('Isi Laporan')
                                    ->content(fn ($record) => $record->isi),

                                

                                Placeholder::make('kategoris')
                                    ->label('Kategori')
                                    ->content(fn ($record) => $record->kategoris->pluck('nama_kategori')->implode(', ')),

                                Placeholder::make('lampiran')
                                    ->label('Lampiran')
                                    ->content(function ($record) {
                                        if (!$record->lampiran) return '-';
                                        $lampiran = json_decode($record->lampiran, true);
                                        return new HtmlString(
                                            collect($lampiran)->map(function ($path, $index) {
                                                $url = asset('storage/' . $path);
                                                $label = 'Lampiran ' . ($index + 1);
                                                return "<a href='{$url}' target='_blank' class='text-primary-600 underline hover:text-primary-700 transition'>{$label}</a>";
                                            })->implode('<br>')
                                        );
                                    }),
                            ]),

                            Group::make([
                                Placeholder::make('updated_at')
                                    ->label('Diperbarui Pada')
                                    ->content(fn ($record) => $record->updated_at
                                        ? $record->updated_at->timezone('Asia/Jakarta')->format('d M Y H:i')
                                        : '-')
                                    ->extraAttributes(['class' => 'font-semibold text-gray-700']),

                                Placeholder::make('nama')
                                    ->label('Nama Pelapor')
                                    ->content(fn ($record) => $record->nama),

                                Placeholder::make('nomor_wa')
                                    ->label('No. WhatsApp')
                                    ->content(fn ($record) => $record->nomor_wa),

                                Placeholder::make('email')
                                    ->label('Email')
                                    ->content(fn ($record) => $record->email),

                                Placeholder::make('lokasi')
                                    ->label('Lokasi')
                                    ->content(fn ($record) => $record->lokasi),
                            ]),
                        ]),
                ])
                ->columns(1),

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
                                ->required(),

                            Select::make('opd_id')
                                ->label('OPD Penanggung Jawab')
                                ->options(\App\Models\Opd::pluck('nama', 'id'))
                                ->searchable()
                                ->required()
                                ->disabled(fn () => Auth::user()?->role !== 'superadmin'),

                            // Toggle::make('is_visible')
                            //     ->label('Tampilkan ke Publik')
                            //     ->onColor('success')
                            //     ->offColor('danger')
                            //     ->visible(fn () => Auth::user()?->role === 'superadmin'),
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
                    ->searchable(),
                TextColumn::make('judul')
                    ->sortable()
                    ->searchable()
                    ->limit(20),
                TextColumn::make('nama')
                    ->label('Pelapor')
                    ->searchable()
                    ->limit(15),
                TextColumn::make('status')  
                    ->searchable()
                    ->badge()
                    ->colors([
                        'danger' => 'Menunggu',
                        'warning' => 'Diproses',
                        'success' => 'Selesai',
                    ]),
                TextColumn::make('opd.nama')
                    ->searchable()
                    ->label('OPD')
                    ->limit(15),
                TextColumn::make('created_at')
                    ->label('Dibuat tanggal')
                    ->searchable()
                    ->sortable()
                    ->dateTime('d M Y'),
                ToggleColumn::make('is_visible')
                    ->label('Tampilkan')
                    ->onIcon('heroicon-o-eye')
                    ->offIcon('heroicon-o-eye-slash')
                    ->onColor('success')
                    ->offColor('danger')
                    ->visible(fn () => Auth::user()?->role === 'superadmin'),
                    
            ])
            ->filters([
                //
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
            // 'create' => Pages\CreateAduan::route('/create'),
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

        return $query->orderBy('created_at', 'desc');
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
