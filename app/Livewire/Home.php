<?php

namespace App\Livewire;

use App\Models\Aduan;
use Livewire\Component;
use Carbon\Carbon;

class Home extends Component
{
    public function render()
    {
        $hariIni = Carbon::today();
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $jumlahHariIni = Aduan::whereDate('created_at', $hariIni)->count();
        $jumlahBulanIni = Aduan::whereMonth('created_at', $bulanIni)->whereYear('created_at', $tahunIni)->count();
        $jumlahTahunIni = Aduan::whereYear('created_at', $tahunIni)->count();
        $jumlahSemua = Aduan::count();

        return view('livewire.home', compact(
            'jumlahHariIni',
            'jumlahBulanIni',
            'jumlahTahunIni',
            'jumlahSemua'
        ));
    }
}
