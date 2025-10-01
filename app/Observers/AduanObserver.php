<?php

namespace App\Observers;

use App\Models\Aduan;
use Illuminate\Support\Facades\Auth; 

class AduanObserver
{
    public function updated(Aduan $aduan): void
    {
        $user = Auth::user();
        $changes = $aduan->getChanges();

         // Verifikasi aduan
        if (isset($changes['is_verified'])) {
            $old = $aduan->getOriginal('is_verified');
            $new = $changes['is_verified'];

           

            activity()
                ->causedBy($user)
                ->performedOn($aduan)
                ->event('verification')
                ->log("{$user->role} {$user->name} memverifikasi aduan {$aduan->nomor_tiket} dari {$old} menjadi {$new}");
        }

        // Jika ada perubahan status
        if (isset($changes['status'])) {
            $old = $aduan->getOriginal('status');
            $new = $changes['status'];

            activity()
                ->causedBy($user)
                ->performedOn($aduan)
                ->event('status_changed')
                ->log("{$user->role} {$user->name} mengubah status aduan {$aduan->nomor_tiket} dari {$old} menjadi {$new}");
        }

        // Jika ada perubahan OPD
        if (isset($changes['opd_id'])) {
            $oldOpd = $aduan->getOriginal('opd_id') ? $aduan->opd->nama : 'belum ditentukan';
            $newOpd = $aduan->opd?->nama ?? '-';

            activity()
                ->causedBy($user)
                ->performedOn($aduan)
                ->event('diteruskan')
                ->log("{$user->role} {$user->name} meneruskan aduan {$aduan->nomor_tiket} ke OPD {$newOpd}");
        }

       
    }

    public function created(Aduan $aduan): void
    {
        $user = Auth::user();

        activity()
            ->causedBy($user)
            ->performedOn($aduan)
            ->event('created')
            ->log("Aduan baru dibuat dengan nomor tiket {$aduan->nomor_tiket}");
    }
}
