<x-mail::message>
# Hasil Verifikasi Aduan

Halo **{{ $aduan->nama }}**,

Mohon maaf, aduan Anda dengan nomor tiket **{{ $aduan->nomor_tiket }}** telah **GAGAL DIVERIFIKASI**.  

Alasan penolakan:  
> {{ $aduan->alasan_tolak }}

Jika Anda merasa perlu, silakan ajukan kembali aduan dengan memperbaiki informasi yang diperlukan.  

Terima kasih,  
**Pemerintah Kabupaten Banjarnegara**
</x-mail::message>
