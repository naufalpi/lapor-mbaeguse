<?php

namespace App\Filament\Resources\KategoriResource\Pages;

use App\Filament\Resources\KategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;


class CreateKategori extends CreateRecord
{
    protected static string $resource = KategoriResource::class;
    
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
            ->body('Kategori baru berhasil ditambahkan.');
    }
}


