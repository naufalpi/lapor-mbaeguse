<x-mail::message>
# Tanggapan Aduan

Halo **{{ $aduan->nama }}**,

Aduan Anda dengan nomor tiket **{{ $aduan->nomor_tiket }}** telah ditanggapi oleh:  
**{{ $tanggapan->user->opd->nama ?? 'Pemerintah Kabupaten Banjarnegara' }}**  Pada **{{ $tanggapan->created_at->translatedFormat('d F Y, H:i') }}**

---

**Isi Tanggapan:**  
{{ $tanggapan->isi_tanggapan }}

<x-mail::button :url="url('/aduan/'.$aduan->slug)">
Lihat Detail Aduan
</x-mail::button>

Terima kasih,  
**Pemerintah Kabupaten Banjarnegara**
</x-mail::message>
