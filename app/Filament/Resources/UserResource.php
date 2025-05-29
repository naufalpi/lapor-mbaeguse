<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Opd;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;    




class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Manajemen Data';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Admin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $context) => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state)),
                Forms\Components\Select::make('role')
                    ->options([
                        'superadmin' => 'Super Admin',
                        'opd' => 'Admin OPD',
                    ])
                    ->required(),
                Forms\Components\Select::make('opd_id')
                    ->label('OPD')
                    ->options(Opd::pluck('nama', 'id'))
                    ->searchable()
                    ->visible(fn ($get) => $get('role') === 'opd')
                    ->required(fn ($get) => $get('role') === 'opd'),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('role')->badge()->colors([
                    'success' => 'superadmin',
                    'info' => 'opd',
                ]),
                Tables\Columns\TextColumn::make('opd.nama')->label('OPD')->sortable()->limit(30)->searchable(),

                // ✅ Kolom status online/offline
                Tables\Columns\TextColumn::make('last_online_status')
                    ->label('Status Online')
                    ->getStateUsing(function ($record) {
                        $onlineKey = 'user-is-online-' . $record->id;
                        $lastOnlineKey = 'user-last-online-' . $record->id;

                        if (Cache::has($onlineKey)) {
                            return '<span style="color:green;font-weight:bold;">Online</span>';
                        }

                        $lastOnline = Cache::get($lastOnlineKey);
                        if ($lastOnline) {
                            return 'Last online ' . Carbon::parse($lastOnline)->diffForHumans();
                        }

                        return 'Offline';
                    })->html(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    
    public static function getEloquentQuery(): Builder
    {
        if (Auth::check() && Auth::user()->role === 'superadmin') {
            return parent::getEloquentQuery();
        }

        return static::getModel()::query()->whereNull('id');
    }

    public static function canAccess(): bool
    {
        return Auth::check() && Auth::user()->role === 'superadmin';
    }

}
