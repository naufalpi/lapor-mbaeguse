<?php

namespace App\Livewire\Components;

use App\Models\Aduan;
use App\Models\Kategori;
use App\Models\Opd;
use Livewire\Component;
use Livewire\WithPagination;

class AduanCardList extends Component
{
    use WithPagination;

    public $search = '';

    public $filterKategori = '';
    public $filterOpd = '';
    public $filterStatus = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination saat search berubah
    }

    public function updatingFilterKategori()
    {
        $this->resetPage();
    }

    public function updatingFilterOpd()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $aduans = Aduan::with('kategoris')
            ->where('is_visible', true)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('judul', 'like', '%' . $this->search . '%')
                    ->orWhere('isi', 'like', '%' . $this->search . '%')
                    ->orWhere('nomor_tiket', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterKategori, function ($query) {
                $query->whereHas('kategoris', function ($q) {
                    $q->where('kategoris.id', $this->filterKategori); // <- FIX disini
                });
            })
            ->when($this->filterOpd, function ($query) {
                $query->where('opd_id', $this->filterOpd);
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9);

            // ambil data kategori & opd untuk filter dropdown
            $kategoris = Kategori::orderBy('nama_kategori')->get();
            $opds = Opd::orderBy('nama')->get();


        return view('livewire.components.aduan-card-list', compact('aduans', 'kategoris', 'opds'));
    }
}
