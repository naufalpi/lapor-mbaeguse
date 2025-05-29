<?php

namespace App\Livewire;

use App\Models\Aduan;
use App\Models\Kategori;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAduan extends Component
{
    use WithFileUploads;

    public $nama;
    public $nomor_wa;
    public $email;
    public $lokasi;
    public $judul;
    public $isi;
    public $kategori = [];

    public $lampiran = [];

     protected $rules = [
        'nama' => 'required|string|max:100',
        'nomor_wa' => 'required|digits_between:9,15',
        'email' => 'nullable|email|max:100',
        'lokasi' => 'required|string|max:255',
        'judul' => 'required|string|max:150',
        'isi' => 'required|string|max:2000',
        'kategori' => 'required|array',
        'kategori.*' => 'exists:kategoris,id',
        'lampiran.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function removeFile($index)
    {
        unset($this->lampiran[$index]);
        $this->lampiran = array_values($this->lampiran); // reset index
    }

    #[On('kirimAduan')]
    public function submit()
    {
        $validated = $this->validate();

        $aduan = new Aduan();
        $aduan->nama = $this->nama;
        $aduan->nomor_wa = $this->nomor_wa;
        $aduan->email = $this->email;
        $aduan->lokasi = $this->lokasi;
        $aduan->judul = $this->judul;
        $aduan->isi = $this->isi;
        $aduan->nomor_tiket = 'TKT' . strtoupper(uniqid());
        $aduan->status = 'Menunggu';

        // Simpan dulu untuk dapat id
        $aduan->save();
        $aduan->kategoris()->attach($this->kategori);

        $paths = [];
        foreach ($this->lampiran as $file) {
            if ($file) {
                $paths[] = $file->store('lampiran_aduan', 'public');
            }
        }
        if (count($paths)) {
            $aduan->lampiran = json_encode($paths);
            $aduan->save();
        }


        // Reset form setelah submit
        $this->reset(['nama','nomor_wa','email','lokasi','judul','isi','kategori','lampiran']);

        // Kirim event ke browser untuk SweetAlert
        $this->dispatch('aduanBerhasil');
    }


    #[Title('Lapor Mbae Guse | Buat Aduan')]
    public function render()
    {
        return view('livewire.create-aduan', [
            'semuaKategori' => Kategori::all(),
        ]);
    }
}
