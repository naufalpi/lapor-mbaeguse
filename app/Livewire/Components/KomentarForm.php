<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Aduan;
use App\Models\Komentar;
use App\Models\User;
use App\Notifications\KomentarAduanNotification;

class KomentarForm extends Component
{
    public $aduan;
    public $nama;
    public $email;
    public $pesan;

    protected $rules = [
        'nama' => 'nullable|string|max:255',
        'email' => 'required|email',
        'pesan' => 'required|string',
    ];

    public function mount(Aduan $aduan)
    {
        $this->aduan = $aduan;
    }

    public function submit()
    {
        $validated = $this->validate();

        // Simpan komentar
        $komentar = $this->aduan->komentars()->create([
            'nama' => $this->nama ?: 'Anonim',
            'email' => $this->email,
            'pesan'  => $this->pesan,   // pastikan kolom di DB 'isi'
            'ip_address' => request()->ip(),
        ]);

        // // kirim notification ke superadmin
        // User::where('role', 'superadmin')->get()
        //     ->each(fn($user) => $user->notify(new KomentarAduanNotification($komentar)));

        // // kirim notification ke admin OPD sesuai aduan
        // if ($this->aduan->opd_id) {
        //     User::where('role', 'opd')->where('opd_id', $this->aduan->opd_id)->get()
        //         ->each(fn($user) => $user->notify(new KomentarAduanNotification($komentar)));
        // }

        // Reset form
        $this->reset(['nama', 'email', 'pesan']);

        // Trigger event Livewire untuk frontend
        $this->dispatch('komentarTerkirim');
    }

    public function render()
    {
        return view('livewire.components.komentar-form');
    }
}
