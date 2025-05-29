<?php

namespace App\Filament\Resources\OpdResource\Pages;

use App\Filament\Resources\OpdResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;


class CreateOpd extends CreateRecord
{
    protected static string $resource = OpdResource::class;

    public static function canView(): bool
    {
        return Auth::user()?->role === 'superadmin';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('OPD baru berhasil ditambahkan.');
    }
}
