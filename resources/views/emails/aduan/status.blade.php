<x-mail::message>
# Perubahan Status Aduan

Halo **{{ $aduan->nama }}**,  

Aduan Anda dengan nomor tiket **{{ $aduan->nomor_tiket }}** telah diperbarui statusnya menjadi: 
**{{ ucfirst($aduan->status) }}**

<x-mail::button :url="url('/aduan')">
Cek Status Aduan
</x-mail::button>

Terima kasih,  
**Pemerintah Kabupaten Banjarnegara**
</x-mail::message>
