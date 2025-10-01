<section class="relative min-h-screen bg-gray-800 overflow-hidden">
    <img src="{{ asset('images/bg-bna.png') }}"
        alt="Hero Background"
        class="absolute inset-0 object-cover w-full h-full opacity-60 mix-blend-multiply" />

  <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">
    <div class="grid lg:grid-cols-2 gap-12 items-center min-h-[calc(100vh-5rem)]">
        <!-- Kiri: Teks -->
        <div class="flex flex-col justify-center text-center lg:text-left space-y-6">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight drop-shadow-lg">
                Selamat Datang di <br class="hidden sm:inline">Lapor Mbae Guse
            </h1>
            <p class="text-lg sm:text-xl text-gray-300 max-w-xl mx-auto lg:mx-0">
                Portal Resmi Aduan Pemerintah Kabupaten Banjarnegara. Sampaikan keluhan, aspirasi, dan permintaan informasi Anda secara mudah dan cepat.
            </p>
            <div>
                <a href="{{ route('aduans.create') }}" wire:navigate
                    class="inline-flex items-center gap-2 py-3 px-6 bg-gradient-to-br from-purple-600 to-blue-500 text-white text-base font-semibold rounded-xl shadow-md hover:scale-105 hover:from-purple-700 hover:to-blue-600 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Lapor Aduan
                </a>
            </div>
        </div>

        <!-- Kanan: Statistik -->
        <div class="flex justify-center lg:justify-end">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-xl text-white w-full max-w-md">
                <h3 class="text-2xl font-bold text-center mb-6">📊 Statistik Aduan Masuk</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="bg-white/10 rounded-lg p-4 text-center shadow-inner">
                        <p class="text-gray-300">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                        <p class="text-2xl font-bold">{{ $jumlahHariIni }}</p>
                    </div>
                    <div class="bg-white/10 rounded-lg p-4 text-center shadow-inner">
                        <p class="text-gray-300">Bulan {{ \Carbon\Carbon::now()->translatedFormat('F') }}</p>
                        <p class="text-2xl font-bold">{{ $jumlahBulanIni }}</p>
                    </div>
                    <div class="bg-white/10 rounded-lg p-4 text-center shadow-inner">
                        <p class="text-gray-300">Tahun {{ date('Y') }}</p>
                        <p class="text-2xl font-bold">{{ $jumlahTahunIni }}</p>
                    </div>
                    <div class="bg-blue-600/80 rounded-lg p-4 text-center shadow-lg">
                        <p class="text-white font-semibold">Semua</p>
                        <p class="text-2xl font-extrabold">{{ $jumlahSemua }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
