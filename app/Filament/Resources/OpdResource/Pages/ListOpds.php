<?php

namespace App\Filament\Resources\OpdResource\Pages;

use App\Filament\Resources\OpdResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListOpds extends ListRecords
{
    protected static string $resource = OpdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Kelola OPD';
    }

    public function getCreateButtonLabel(): string
    {
        return 'Tambah OPD Baru';
    }

    public static function canView(): bool
    {
        return Auth::user()?->role === 'superadmin';
    }
}
