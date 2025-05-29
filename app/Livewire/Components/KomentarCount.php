<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Aduan;

class KomentarCount extends Component
{
    public $aduan;

    protected $listeners = ['komentarTerkirim' => '$refresh'];

    public function render()
    {
        return view('livewire.components.komentar-count', [
            'jumlahKomentar' => $this->aduan->komentars()->count(),
        ]);
    }
}
