<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TanggapanResource\Pages;
use App\Filament\Resources\TanggapanResource\RelationManagers;
use App\Models\Tanggapan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TanggapanResource extends Resource
{
    protected static ?string $model = Tanggapan::class;

    
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
     protected static ?string $navigationGroup = 'Kelola Aduan';
    protected static ?string $label = 'Tanggapan/Tindak Lanjut';
    protected static ?string $pluralLabel = 'List Tanggapan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user();

        $columns = [
            TextColumn::make('aduan.nomor_tiket')->label('Nomor Tiket'),
            TextColumn::make('aduan.judul')->label('Judul')->limit(20),
            TextColumn::make('aduan.opd.nama')
                ->label('OPD')
                ->formatStateUsing(fn ($state, $record) => $record->aduan->opd?->nama ?? '-'),
            TextColumn::make('isi_tanggapan')->label('Isi Tanggapan')->limit(40),
        ];

        if ($user && $user->role === 'superadmin') {
            $columns[] = TextColumn::make('user.name')->label('Admin');
        }

        return $table
            ->columns($columns)
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTanggapans::route('/'),
        ];
    }

    protected static function booted()
    {
        static::addGlobalScope('opd_filter', function (Builder $builder) {
            $user = Auth::user();

            if ($user && $user->role === 'opd') {
                $builder->whereHas('aduan', function ($query) use ($user) {
                    $query->where('opd_id', $user->opd_id);
                });
            }
            // superadmin tidak dibatasi
        });
    }
}
