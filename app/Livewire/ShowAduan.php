<?php

namespace App\Livewire;

use App\Models\Aduan;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Lazy]
class ShowAduan extends Component
{
    public $slug;
    public $aduan;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->aduan = Aduan::with(['kategoris', 'tanggapans', 'komentars'])->where('slug', $slug)->firstOrFail();
    }

    public function placeholder()
    {
        return view('placeholder.show-aduan');
    }

    public function backToIndex()
    {
        return redirect()->route('aduans.index');
    }


    #[Title('Lapor Mbae Guse | Detail Aduan')]
    public function render()
    {
        return view('livewire.show-aduan');
    }
}
