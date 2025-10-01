<?php

namespace App\Filament\Resources\TanggapanResource\Pages;

use App\Filament\Resources\TanggapanResource;
use App\Models\RiwayatAduan;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateTanggapan extends CreateRecord
{
    protected static string $resource = TanggapanResource::class;

    protected function afterSave(): void
    {
        

    }
}
