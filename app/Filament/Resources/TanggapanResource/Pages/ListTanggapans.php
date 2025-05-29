<?php

namespace App\Filament\Resources\TanggapanResource\Pages;

use App\Filament\Resources\TanggapanResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListTanggapans extends ListRecords
{
    protected static string $resource = TanggapanResource::class;

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery()->with('aduan.opd');

        $user = Auth::user();

        if ($user->role === 'opd') {
            $query->whereHas('aduan', function (Builder $q) use ($user) {
                $q->where('opd_id', $user->opd_id);
            });
        }

        return $query;
    }

    protected function getHeaderActions(): array
    {
        return []; // Sembunyikan tombol new
    }

    

    protected function getTableRecordUrlUsing(): \Closure
    {
        return fn ($record) => route('filament.admin.resources.aduans.edit', $record->aduan_id);
    }
}
