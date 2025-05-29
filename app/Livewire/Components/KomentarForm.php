<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Aduan;
use App\Models\Komentar;


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

        $this->aduan->komentars()->create([
            'nama' => $this->nama ?: 'Anonim',
            'email' => $this->email,
            'pesan' => $this->pesan,
        ]);

        $this->reset(['nama', 'email', 'pesan']);

        $this->dispatch('komentarTerkirim');

    }

    public function render()
    {
        return view('livewire.components.komentar-form');
    }
}
