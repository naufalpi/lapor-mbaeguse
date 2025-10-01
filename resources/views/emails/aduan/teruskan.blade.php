<x-mail::message>
# Aduan diteruskan ke OPD Terkait

Halo **{{ $aduan->nama }}**,  

Aduan Anda dengan nomor tiket **{{ $aduan->nomor_tiket }}** telah diterukan ke OPD terkait: 
**{{ $aduan->opd->nama ?? 'OPD terkait' }}**

<x-mail::button :url="url('/aduan')">
Cek Aduan Anda
</x-mail::button>

Terima kasih,  
**Pemerintah Kabupaten Banjarnegara**
</x-mail::message>
