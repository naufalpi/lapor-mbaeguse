<x-mail::message>
# Hasil Verifikasi Aduan

Halo **{{ $aduan->nama }}**,

Aduan Anda dengan nomor tiket **{{ $aduan->nomor_tiket }}** telah **BERHASIL DIVERIFIKASI**.  
Cek secara berkala status aduan Anda di sistem.

<x-mail::button :url="url('/aduan/'.$aduan->nomor_tiket)">
Cek Status Aduan
</x-mail::button>

Terima kasih,  
**Pemerintah Kabupaten Banjarnegara**
</x-mail::message>
