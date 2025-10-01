<?php

namespace App\Filament\Resources\AduanResource\Pages;

use App\Filament\Resources\AduanResource;
use App\Models\RiwayatAduan;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AduanStatusMail;
use App\Mail\AduanVerifikasiDiterimaMail;
use App\Mail\AduanVerifikasiDitolakMail;
use App\Mail\AduanTeruskanMail;
use App\Mail\AduanTanggapanMail;

class EditAduan extends EditRecord
{
    protected static string $resource = AduanResource::class;

    protected $oldStatus;
    protected $oldTanggapan;
    protected $oldOpdId;
    protected $oldIsVerified;

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
        // simpan nilai lama untuk perbandingan
        $this->oldStatus = $this->record->status;
        $this->oldTanggapan = $this->record->tanggapan;
        $this->oldOpdId = $this->record->opd_id;
        $this->oldIsVerified = $this->record->is_verified;

        return $data;
    }

    protected function afterSave(): void
    {
        $user = Auth::user();
        $userId = $user->id;
        $userOpdNama = optional($user->opd)->nama ?? 'Pemerintah Kabupaten Banjarnegara';
        $aduan = $this->record;

        if ($aduan->is_verified == 1 && $aduan->is_visible != 1) {
            $aduan->update(['is_visible' => 1]);
        }

        // ====== CATATAN RIWAYAT ======

        // perubahan verifikasi
        if ($this->oldIsVerified !== $aduan->is_verified) {
            if ($aduan->is_verified === 1) {
                // otomatis tampil publik
        
                RiwayatAduan::create([
                    'aduan_id'   => $aduan->id,
                    'user_id'    => $userId,
                    'status'     => 'Diverifikasi',
                    'keterangan' => 'Aduan diverifikasi dan diterima oleh ' . $userOpdNama,
                ]);
            } elseif ($aduan->is_verified === 2) {
                RiwayatAduan::create([
                    'aduan_id'   => $aduan->id,
                    'user_id'    => $userId,
                    'status'     => 'Ditolak',
                    'keterangan' => 'Aduan ditolak saat verifikasi oleh ' . $userOpdNama,
                ]);
            }
        }

        // perubahan verifikasi
        if ($this->oldIsVerified !== $aduan->is_verified && $aduan->is_verified === '1') {
            RiwayatAduan::create([
                'aduan_id'   => $aduan->id,
                'user_id'    => $userId,
                'status'     => 'Diverifikasi',
                'keterangan' => 'Aduan berhasil diverifikasi oleh ' . $userOpdNama,
            ]);
        }

        // perubahan status menjadi selesai
        if ($this->oldStatus !== $aduan->status && $aduan->status === 'Selesai') {
            RiwayatAduan::create([
                'aduan_id'   => $aduan->id,
                'user_id'    => $userId,
                'status'     => 'Diselesaikan',
                'keterangan' => 'Aduan diselesaikan oleh ' . $userOpdNama,
            ]);
        }

        // perubahan OPD
        $oldOpdNama = optional(\App\Models\Opd::find($this->oldOpdId))->nama;
        $newOpdNama = optional($aduan->opd)->nama;

        if ($oldOpdNama !== $newOpdNama && $newOpdNama !== null) {
            RiwayatAduan::create([
                'aduan_id'   => $aduan->id,
                'user_id'    => $userId,
                'status'     => 'Diteruskan',
                'keterangan' => 'Aduan diteruskan ke ' . $newOpdNama,
            ]);
        }

        // ====== EMAIL NOTIFIKASI ======

        if ($aduan->email) {
            
            if ($this->oldIsVerified != $aduan->is_verified) {
                if ($aduan->is_verified) {
                    // Verifikasi diterima
                    $aduan->update(['is_visible' => true]); // otomatis tampil di publik
                    if ($aduan->email) {
                        Mail::to($aduan->email)->send(new AduanVerifikasiDiterimaMail($aduan));
                    }
                } else {
                    // Verifikasi ditolak
                    if ($aduan->email) {
                        Mail::to($aduan->email)->send(new AduanVerifikasiDitolakMail($aduan));
                    }
                }
            }

            // status berubah
            if ($this->oldStatus !== $aduan->status) {
                Mail::to($aduan->email)->send(new AduanStatusMail($aduan));
            }

            if ($this->oldOpdId != $aduan->opd_id && $aduan->opd_id) {
                // Ambil semua user dengan opd_id yang sesuai
                $opdUsers = \App\Models\User::where('opd_id', $aduan->opd_id)
                    ->where('role', 'opd') // pastikan hanya admin OPD, bukan superadmin
                    ->pluck('email');

                if ($opdUsers->isNotEmpty()) {
                    foreach ($opdUsers as $email) {
                        Mail::to($email)->send(new \App\Mail\AduanDiteruskanOpdMail($aduan));
                    }
                }
            }



            // opd_id berubah
            if ($this->oldOpdId != $aduan->opd_id && $aduan->opd_id) {
                Mail::to($aduan->email)->send(new AduanTeruskanMail($aduan));
            }

        
        }
    }
}
