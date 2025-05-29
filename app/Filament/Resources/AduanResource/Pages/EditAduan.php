<?php

namespace App\Filament\Resources\AduanResource\Pages;

use App\Filament\Resources\AduanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;


class EditAduan extends EditRecord
{
    protected static string $resource = AduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
     
    public function getTitle(): string
    {
        return 'Kelola Aduan';
    }

    public function getBreadcrumb(): string
    {
        return 'Kelola';
    }
}
