<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class AlurPengaduan extends Component
{

    #[Title('Lapor Mbae Guse | Alur Pengaduan')]
    public function render()
    {
        return view('livewire.alur-pengaduan');
    }
}
