<?php

namespace App\Livewire;

use App\Models\Aduan;
use Carbon\Carbon;
use App\Mail\AduanTerkirimMail;
use App\Mail\AdminAduanNotification;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\Kategori;
use Livewire\Attributes\On;
use App\Models\RiwayatAduan;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth; 

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
        'nama' => 'nullable|string|max:100',
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
        $today = Carbon::today();
        $countToday = Aduan::whereDate('created_at', $today)->count() + 1;
        $day   = now()->format('d');
        $month = now()->format('m');
        $year  = now()->format('y'); // 2 digit tahun

        // Jika nama kosong, isi dengan 'Anonim'
        if (empty(trim($this->nama))) {
            $this->nama = 'Anonim';
        }

        $aduan = new Aduan();
        $aduan->nama = $this->nama;
        $aduan->nomor_wa = $this->nomor_wa;
        $aduan->email = $this->email;
        $aduan->lokasi = $this->lokasi;
        $aduan->judul = $this->judul;
        $aduan->isi = $this->isi;
        $aduan->nomor_tiket = 'TKT' . $day . $month . $year . str_pad($countToday, 2, '0', STR_PAD_LEFT);
        $aduan->status = 'Menunggu';
        $aduan->ip_address = request()->ip();

        // Simpan dulu untuk dapat id
        $aduan->save();

        if ($aduan->email) {
            Mail::to($aduan->email)->send(new AduanTerkirimMail($aduan));
            Mail::to('naufalsjob@gmail.com')->send(new AdminAduanNotification($aduan));
        }
        
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

        // RiwayatAduan::create([
        //     'aduan_id' => $aduan->id,
        //     'user_id' => null, // guest user
        //     'status' => 'Dibuat',
        //     'keterangan' => 'Aduan dibuat oleh',
        // ]);


        // Reset form setelah submit
        $this->reset(['nama','nomor_wa','email','lokasi','judul','isi','kategori','lampiran']);

        // Kirim event ke browser untuk SweetAlert
        $this->dispatch('aduanBerhasil', nomorTiket: $aduan->nomor_tiket);

    }


    #[Title('Lapor Mbae Guse | Buat Aduan')]
    public function render()
    {
        return view('livewire.create-aduan', [
            'semuaKategori' => Kategori::all(),
        ]);
    }
}
