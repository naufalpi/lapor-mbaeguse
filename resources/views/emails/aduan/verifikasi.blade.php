<x-mail::message>
# Verifikasi Aduan

Halo **{{ $aduan->nama }}**,  

Aduan Anda dengan nomor tiket **{{ $aduan->nomor_tiket }}** telah telah diverifikasi. Cek secara berkala status aduan Anda!

<x-mail::button :url="url('/aduan')">
Cek Status Aduan
</x-mail::button>

Terima kasih,  
**Pemerintah Kabupaten Banjarnegara**
</x-mail::message>
