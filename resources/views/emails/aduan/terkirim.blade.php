<x-mail::message>
# Terima Kasih atas Aduan Anda

Halo **{{ $aduan->nama }}**,  
Terima kasih telah menyampaikan aduan kepada Pemerintah Kabupaten Banjarnegara.

Nomor tiket aduan Anda adalah:  
**{{ $aduan->nomor_tiket }}**

Silakan simpan nomor tiket ini untuk memantau status aduan Anda.

<x-mail::button :url="url('/aduan')">
Cek Status Aduan
</x-mail::button>

Hormat kami,<br>
**Pemerintah Kabupaten Banjarnegara**
</x-mail::message>
