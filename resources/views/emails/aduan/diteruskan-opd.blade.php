<x-mail::message>
# Aduan Baru Diteruskan

Yth. **{{ $aduan->opd->nama }}**,

Anda menerima aduan baru yang telah diteruskan oleh Admin Utama Lapor Mbae Guse.

**Judul Aduan:**  
{{ $aduan->judul }}

**Nomor Tiket:**  
{{ $aduan->nomor_tiket }}

**Isi Aduan:**  
{{ $aduan->isi }}

<x-mail::button :url="url('/admin/aduans/'.$aduan->id)">
Lihat di Dashboard
</x-mail::button>

Terima kasih,  
**Pemerintah Kabupaten Banjarnegara**
</x-mail::message>
