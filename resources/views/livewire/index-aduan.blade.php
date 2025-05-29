<div class="max-w-7xl mx-auto px-4 py-20">
  <h1 class="text-3xl font-bold text-gray-900 mb-4">Daftar Aduan Masyarakat</h1>
  <p class="text-gray-600 mb-8 font-semibold">Berikut adalah daftar laporan masyarakat Kabupaten Banjarnegara.</p>

  <!-- Tombol Create Aduan -->
  {{-- <div class="mb-8">
    <a href="{{ route('aduans.create') }}" wire:navigate
       class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
      + Buat Aduan Baru
    </a>
  </div> --}}

  <section>
    <livewire:components.aduan-card-list />
  </section>
</div>
