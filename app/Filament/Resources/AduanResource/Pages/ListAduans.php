<?php

namespace App\Filament\Resources\AduanResource\Pages;

use App\Filament\Resources\AduanResource;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAduans extends ListRecords
{
    protected static string $resource = AduanResource::class;

    public function getTitle(): string
    {
        return 'Kelola Aduan';
    }

    protected function canCreate(): bool
    {
        return false;
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua'),

            'belum-verifikasi' => Tab::make('Belum Diverifikasi')
                ->modifyQueryUsing(fn (Builder $query) => 
                    $query->where('is_visible', 'false')
                ),

            'menunggu' => Tab::make('Menunggu')
                ->modifyQueryUsing(fn (Builder $query) => 
                    $query->where('status', 'menunggu')
                ),

            'diproses' => Tab::make('Diproses')
                ->modifyQueryUsing(fn (Builder $query) => 
                    $query->where('status', 'diproses')
                ),

            'selesai' => Tab::make('Selesai')
                ->modifyQueryUsing(fn (Builder $query) => 
                    $query->where('status', 'selesai')
                ),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
