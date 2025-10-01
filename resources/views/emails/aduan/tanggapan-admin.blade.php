<x-mail::message>
# Notifikasi Tanggapan Aduan

Halo **Admin Pengelola Aduan**,  

Ada tanggapan baru untuk aduan berikut:  

- **Nomor Tiket:** {{ $aduan->nomor_tiket }}  
- **Judul Aduan:** {{ $aduan->judul }}  
- **Pelapor:** {{ $aduan->nama }}  

Isi Tanggapan dari **{{ $tanggapan->user->opd->nama ?? 'Pemerintah Kabupaten Banjarnegara' }}**  pada **{{ $tanggapan->created_at->translatedFormat('d F Y, H:i') }}** :    
{!! nl2br(e($tanggapan->isi_tanggapan ?? '-')) !!}

<x-mail::button :url="url('/admin/aduans/' . $aduan->id . '/edit')">
Lihat Detail Aduan
</x-mail::button>

Terima kasih,  
**Sistem Lapor Mbae Guse**
</x-mail::message>
