<?php

namespace App\Observers;

use App\Models\Tanggapan;
use Illuminate\Support\Facades\Auth;

class TanggapanObserver
{
    public function created(Tanggapan $tanggapan): void
    {
        $user = Auth::user();

        activity()
            ->causedBy($user)
            ->performedOn($tanggapan)
            ->event('response')
            ->log("admin {$user->role} {$user->name} menanggapi aduan {$tanggapan->aduan->nomor_tiket}");
    }

    public function updated(Tanggapan $tanggapan): void
    {
        $user = Auth::user();

        activity()
            ->causedBy($user)
            ->performedOn($tanggapan)
            ->event('response_updated')
            ->log("admin {$user->role} {$user->name} memperbarui tanggapan untuk aduan {$tanggapan->aduan->nomor_tiket}");
    }

    public function deleted(Tanggapan $tanggapan): void
    {
        $user = Auth::user();

        activity()
            ->causedBy($user)
            ->performedOn($tanggapan)
            ->event('response_deleted')
            ->log("admin {$user->role} {$user->name} menghapus tanggapan untuk aduan {$tanggapan->aduan->nomor_tiket}");
    }
}
