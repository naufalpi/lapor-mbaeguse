<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Aduan;
use App\Models\Komentar;

class KomentarList extends Component
{
    public $aduan;

    protected $listeners = ['komentarTerkirim' => '$refresh'];

    public function render()
    {
        return view('livewire.components.komentar-list', [
            'komentars' => $this->aduan->komentars()->latest()->get()
        ]);
    }
}
