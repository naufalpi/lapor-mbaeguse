<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class IndexAduan extends Component
{

    #[Title('Lapor Mbae Guse | Aduan')]
    public function render()
    {
        return view('livewire.index-aduan');
    }
}
