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
        $tanggapan = $this->record;

        RiwayatAduan::create([
            'aduan_id'   => $tanggapan->aduan_id,
            'user_id'    => optional(Auth::user())->id,
            'status'     => 'ditanggapi',
            'keterangan' => 'Tanggapan diberikan oleh admin',
        ]);
    }
}
