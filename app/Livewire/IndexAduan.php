<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Lazy;


#[Lazy]
class IndexAduan extends Component
{

    public function placeholder()
    {
        return view('placeholder.index-aduan');
    }

    #[Title('Lapor Mbae Guse | Aduan')]
    public function render()
    {
        return view('livewire.index-aduan');
    }
}
