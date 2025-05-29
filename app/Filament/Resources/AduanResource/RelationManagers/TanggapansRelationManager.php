<?php

namespace App\Filament\Resources\AduanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TanggapansRelationManager extends RelationManager
{
    protected static string $relationship = 'tanggapans';



    public static function getModelLabel(): string
    {
        return 'Tanggapan';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Tanggapan-Tanggapan';
    }

    public static function getCreateButtonLabel(): string
    {
        return 'Tambah Tanggapan';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('isi_tanggapan')
                    ->label('Isi Tanggapan')
                    ->placeholder('Tulis tanggapan Anda di sini...')
                    ->rows(5)
                    ->autosize()
                    ->maxLength(1000)
                    ->helperText('Maksimal 1000 karakter.')
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes(['class' => 'text-sm']), // opsional

                Forms\Components\Hidden::make('user_id')
                    ->default(fn () => Auth::id())
                    ->dehydrated(),
            ]);

    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('isi_tanggapan')
            ->columns([
                Tables\Columns\TextColumn::make('isi_tanggapan'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable(),   
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }
}
