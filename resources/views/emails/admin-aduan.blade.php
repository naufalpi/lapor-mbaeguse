<x-mail::message>
# 📢 Aduan Baru Masuk

Ada aduan baru yang dikirim masyarakat:

**Judul:** {{ $aduan->judul }}  
**Nama Pengadu:** {{ $aduan->nama }}  
**Lokasi:** {{ $aduan->lokasi }}  
**Nomor Tiket:** {{ $aduan->nomor_tiket }}  
**Dibuat pada:** {{ $aduan->created_at->format('d M Y') }}, Pukul {{ $aduan->created_at->format('H:i') }} WIB

<x-mail::panel>
{{ $aduan->isi }}
</x-mail::panel>

<x-mail::button :url="url('/admin')">
Buka Dashboard Admin
</x-mail::button>

Terima kasih,<br>
**Sistem Lapor Mbae Guse**
</x-mail::message>
