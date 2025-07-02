<?php

namespace App\Filament\Resources\AduanResource\Pages;

use App\Filament\Resources\AduanResource;
use App\Models\RiwayatAduan;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditAduan extends EditRecord
{
    protected static string $resource = AduanResource::class;

    protected $oldStatus;
    protected $oldTanggapan;
    protected $oldOpdId;

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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Simpan nilai sebelum perubahan
        $this->oldStatus = $this->record->status;
        $this->oldTanggapan = $this->record->tanggapan;
        $this->oldOpdId = $this->record->opd_id;

        return $data;
    }

    protected function afterSave(): void
    {
        $user = Auth::user();
        $userId = $user->id;
        $userOpdNama = optional($user->opd)->nama ?? 'Pemerintah Kabupaten Banjarnegara';

        // Cek perubahan status menjadi "Selesai"
        if ($this->oldStatus !== $this->record->status && $this->record->status === 'Selesai') {
            RiwayatAduan::create([
                'aduan_id'   => $this->record->id,
                'user_id'    => $userId,
                'status'     => 'Diselesaikan',
                'keterangan' => 'Aduan diselesaikan oleh ' . $userOpdNama,
            ]);
        }

        // Cek perubahan OPD (hanya catat jika nama OPD berbeda)
        $oldOpdNama = optional(\App\Models\Opd::find($this->oldOpdId))->nama;
        $newOpdNama = optional($this->record->opd)->nama;

        if ($oldOpdNama !== $newOpdNama && $newOpdNama !== null) {
            RiwayatAduan::create([
                'aduan_id'   => $this->record->id,
                'user_id'    => $userId,
                'status'     => 'Disposisi',
                'keterangan' => 'Aduan didisposisikan ke ' . $newOpdNama,
            ]);
        }
    }



}
