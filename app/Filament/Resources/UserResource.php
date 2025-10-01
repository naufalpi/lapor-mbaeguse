<?php

namespace App\Filament\Resources;

use App\Models\Opd;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Cache;
use App\Filament\Exports\UserExporter;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;    
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\ExportBulkAction;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;





class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Manajemen Data';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Username')
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
                        'bupati' => 'Bupati',
                        'wabup' => 'Wakil Bupati',
                        'sekda' => 'Sekretaris Daerah',
                        'superadmin' => 'Super Admin',
                        'opd' => 'Admin OPD',
                    ])
                    ->required()
                    ->live(),
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
                Tables\Columns\TextColumn::make('name')->label('Username')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('role')->badge()->colors([
                    'success' => 'superadmin',
                    'warning' => 'opd',
                    'info' => 'bupati',
                    'info' => 'wabup',
                    'info' => 'sekda',
                ]),
                Tables\Columns\TextColumn::make('opd.nama')->label('OPD')->sortable()->limit(30)->searchable(),
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
            ->headerActions([
                ExportAction::make()
                    ->exporter(UserExporter::class)
               
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                     ExportBulkAction::make()
                ->exporter(UserExporter::class)
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
