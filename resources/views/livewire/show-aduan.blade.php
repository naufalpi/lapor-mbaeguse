<div class="max-w-7xl bg-white mx-auto px-6 grid grid-cols-1 lg:grid-cols-4 gap-8 py-20">

    {{-- Sidebar Riwayat --}}

    <div class="col-span-1">
        <div class="border border-gray-300 rounded-lg overflow-hidden h-[500px] flex flex-col">
            <h2 class="text-lg font-semibold text-gray-800 bg-gray-100 text-center py-2">
                Riwayat Aduan
            </h2>
            <aside class="overflow-y-auto px-4 pt-4 space-y-6">

        
            <!-- Riwayat Awal: Aduan Dibuat -->
            <div class="ps-2 my-2 first:mt-0">
                <h3 class="text-xs font-medium uppercase text-gray-500">
                    {{ \Carbon\Carbon::parse($aduan->created_at)->translatedFormat('d F Y \P\u\k\u\l H.i') }} WIB
                </h3>
            </div>

            <div class="flex gap-x-3">
                <!-- Icon -->
                <div class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 ">
                    <div class="relative z-10 size-7 flex justify-center items-center">
                        <div class="size-2 rounded-full bg-gray-400 "></div>
                    </div>
                </div>
                <!-- End Icon -->

                <!-- Right Content -->
                <div class="grow pt-0.5 pb-2">
                    <h3 class="flex gap-x-1.5 font-semibold text-gray-800 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        Dibuat
                    </h3>
                    <p class="mt-1 text-md text-gray-600 ">
                        Aduan dibuat oleh {{ $aduan->nama }}
                    </p>
                </div>
                <!-- End Right Content -->
            </div>


       

                 
            @foreach ($aduan->riwayats as $riwayat)
                <!-- Heading -->
                <div class="ps-2 my-2 first:mt-0">
                    <h3 class="text-xs font-medium uppercase text-gray-500 ">   
                        {{ \Carbon\Carbon::parse($riwayat->created_at)->translatedFormat('d F Y \P\u\k\u\l H.i') }} WIB
                    </h3>
                </div>

                <div class="flex gap-x-3">
                    <!-- Icon -->
                    <div class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 ">
                        <div class="relative z-10 size-7 flex justify-center items-center">
                            <div class="size-2 rounded-full bg-gray-400 "></div>
                        </div>
                    </div>
                    <!-- End Icon -->

                    <!-- Right Content -->
                    <div class="grow pt-0.5 pb-2">
                        <h3 class="flex gap-x-1.5 font-semibold text-gray-800 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            {{ $riwayat->status }}
                        </h3>
                        <p class="mt-1 text-md text-gray-600 ">
                             {{ $riwayat->keterangan }}
                        </p>
                    </div>
                    <!-- End Right Content -->
                </div>

                
            @endforeach
       
            </aside>

        </div>
    </div>

    {{-- Konten Utama --}}
    <article class="lg:col-span-3 space-y-6">

        {{-- Info Atas --}}
        <div class="flex flex-wrap items-center gap-4">
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>



                Oleh: <strong>{{ $aduan->nama }}</strong>
            </span>

            <span class="flex items-center gap-1">
                <svg class="w-5 h-5 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16 10 3-3m0 0-3-3m3 3H5v3m3 4-3 3m0 0 3 3m-3-3h14v-3"/>
                </svg>

                Status: 
                <span class="inline-block px-2 py-1 rounded text-sm font-semibold
                    @if($aduan->status === 'Selesai') bg-green-100 text-green-700 
                    @elseif($aduan->status === 'Diproses') bg-yellow-100 text-yellow-700 
                    @else bg-gray-100 text-gray-700 @endif">
                    {{ strtoupper($aduan->status) }}
                </span>
            </span>

            <span class="flex items-center gap-1 ml-auto">
                <svg class="w-5 h-5 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd"/>
                </svg>
                Diadukan pada: <strong>{{ $aduan->created_at->format('d M Y H:i') }}</strong>
            </span>
        </div>

        {{-- Baris 2: Instansi --}}
        <div class="flex flex-wrap items-center gap-2">
            <span class="flex items-center gap-1">
                <svg class="w-5 h-5 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M10.915 2.345a2 2 0 0 1 2.17 0l7 4.52A2 2 0 0 1 21 8.544V9.5a1.5 1.5 0 0 1-1.5 1.5H19v6h1a1 1 0 1 1 0 2H4a1 1 0 1 1 0-2h1v-6h-.5A1.5 1.5 0 0 1 3 9.5v-.955a2 2 0 0 1 .915-1.68l7-4.52ZM17 17v-6h-2v6h2Zm-6-6h2v6h-2v-6Zm-2 6v-6H7v6h2Z" clip-rule="evenodd"/>
                <path d="M2 21a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Z"/>
                </svg>

                Diteruskan ke:
            </span>
            <span class="bg-blue-100 text-black text-sm px-3 py-1 rounded-full">
                {{ $aduan->opd?->nama ?? '-' }}
            </span>
        </div>

        {{-- Baris 3: Nomor Tiket (copyable), Tanggal, Kategori --}}
        <div class="flex flex-wrap items-center gap-4">
            <span class="flex items-center gap-1 relative">
                <!-- Ikon -->
                <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z"/>
                </svg>

                <!-- Label -->
                Nomor Tiket:

                <!-- Span dengan tooltip -->
                <span 
                    class="bg-gray-100 px-2 py-1 rounded cursor-pointer hover:bg-gray-200 transition"
                    x-data
                    @click="navigator.clipboard.writeText('{{ $aduan->nomor_tiket }}')"
                    data-tooltip-target="tooltip-nomor-tiket"
                >
                    <strong>{{ $aduan->nomor_tiket }}</strong>
                </span>

                <!-- Tooltip Flowbite -->
                <div id="tooltip-nomor-tiket" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                    Klik untuk salin
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </span>


            

            <span class="flex items-center gap-1">
                <svg class="w-5 h-5 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M18.045 3.007 12.31 3a1.965 1.965 0 0 0-1.4.585l-7.33 7.394a2 2 0 0 0 0 2.805l6.573 6.631a1.957 1.957 0 0 0 1.4.585 1.965 1.965 0 0 0 1.4-.585l7.409-7.477A2 2 0 0 0 21 11.479v-5.5a2.972 2.972 0 0 0-2.955-2.972Zm-2.452 6.438a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                </svg>
                Kategori: 
                <strong>{{ implode(', ', $aduan->kategoris->pluck('nama_kategori')->toArray()) }}</strong>
            </span>
        </div>
        

        {{-- Judul dan Isi --}}
        <h1 class="text-xl md:text-2xl font-bold text-gray-900">{{ $aduan->judul }}</h1>
        <p class="text-sm md:text-sm text-gray-800 leading-relaxed">
            {{ $aduan->isi }}
        </p>

        

        <!-- Tabs -->
        <div x-data="{ tab: 'tindak' }" class="mt-6">
        {{-- Tab Headers --}}
            <div class="flex flex-wrap gap-6 text-sm pt-4">
                <button @click="tab = 'tindak'" 
                    :class="{ 'font-semibold text-blue-600': tab === 'tindak' }" 
                    class="flex items-center gap-2 focus:outline-none cursor-pointer">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 8h2a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2"></path>
                        <path d="M12 12v6m0 0l-3-3m3 3l3-3M12 4v4m0 0l-3-3m3 3l3-3"></path>
                    </svg>
                    Tindak Lanjut ({{ $aduan->tanggapans->count() }})
                </button>

                <button @click="tab = 'komentar'" 
                    :class="{ 'font-semibold text-blue-600': tab === 'komentar' }" 
                    class="flex items-center gap-2 focus:outline-none cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"></path>
                    </svg>
                    <livewire:components.komentar-count :aduan="$aduan" />
                </button>

                <button @click="tab = 'lampiran'" 
                    :class="{ 'font-semibold text-blue-600': tab === 'lampiran' }" 
                    class="flex items-center gap-2 focus:outline-none cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 15V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10m16 4h2a2 2 0 002-2v-2m-2 4V9a2 2 0 00-2-2H7a2 2 0 00-2 2v10h14z"></path>
                    </svg>
                    Lampiran ({{ $aduan->lampiran ? collect(json_decode($aduan->lampiran))->count() : 0 }})
                </button>

                <button @click="tab = 'lokasi'" 
                    :class="{ 'font-semibold text-blue-600': tab === 'lokasi' }" 
                    class="flex items-center gap-2 focus:outline-none cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2C8.134 2 5 5.134 5 9c0 7.732 7 13 7 13s7-5.268 7-13c0-3.866-3.134-7-7-7z"></path>
                        <circle cx="12" cy="9" r="2.5"></circle>
                    </svg>
                    Lokasi
                </button>
            </div>


            {{-- Tab Contents --}}
            <div class="mt-4">

                <!-- Tindak Lanjut -->
                <div x-show="tab === 'tindak'">
                    @forelse ($aduan->tanggapans as $t)
                        <div class="p-5 mb-4 bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition-all">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-800">
                                        {{ $t->user_id === 1 ? 'Pemerintah Kabupaten Banjarnegara' : $t->user->opd->nama }}
                                    </span>
                                </div>
                                <span class="text-xs text-gray-500">
                                    {{ $t->created_at->format('d M Y H:i') }} WIB
                                </span>
                            </div>

                            {{-- Isi tanggapan --}}
                            <div class="text-sm text-gray-700 leading-relaxed mb-2">
                                {{ $t->isi_tanggapan }}
                            </div>

                            {{-- Lampiran --}}
                           @if ($t->lampiran && is_array($t->lampiran) && count($t->lampiran) > 0)
                                <div class="mt-3">
                                    <span class="block text-xs font-semibold text-gray-600 mb-1">Lampiran:</span>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($t->lampiran as $file)
                                            @php
                                                $url = Storage::url($file);
                                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                            @endphp

                                            @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                                                {{-- Thumbnail gambar --}}
                                                <a href="{{ $url }}" target="_blank" title="{{ basename($file) }}">
                                                    <img src="{{ $url }}" 
                                                        class="w-16 h-16 object-cover rounded border hover:opacity-80 transition" 
                                                        alt="lampiran">
                                                </a>
                                            @elseif($ext === 'pdf')
                                                {{-- Icon PDF --}}
                                                <a href="{{ $url }}" target="_blank" title="{{ basename($file) }}" 
                                                class="inline-flex items-center gap-1 px-2 py-1 text-xs rounded bg-red-50 text-red-700 hover:bg-red-100 border">
                                                    <x-heroicon-o-document-text class="w-4 h-4" />
                                                    PDF
                                                </a>
                                            @elseif(in_array($ext, ['doc','docx']))
                                                {{-- Icon Word --}}
                                                <a href="{{ $url }}" target="_blank" title="{{ basename($file) }}"
                                                class="inline-flex items-center gap-1 px-2 py-1 text-xs rounded bg-blue-50 text-blue-700 hover:bg-blue-100 border">
                                                    <x-heroicon-o-document class="w-4 h-4" />
                                                    Word
                                                </a>
                                            @else
                                                {{-- Icon file umum --}}
                                                <a href="{{ $url }}" target="_blank" title="{{ basename($file) }}"
                                                class="inline-flex items-center gap-1 px-2 py-1 text-xs rounded bg-gray-50 text-gray-700 hover:bg-gray-100 border">
                                                    <x-heroicon-o-paper-clip class="w-4 h-4" />
                                                    File
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="p-4 bg-gray-50 border border-dashed border-gray-300 rounded-lg text-center text-sm text-gray-500">
                            <span>Belum ada tindak lanjut.</span>
                        </div>
                    @endforelse
                </div>



                <!-- Komentar -->
                <div x-show="tab === 'komentar'">
                    <livewire:components.komentar-list :aduan="$aduan" />
                    <livewire:components.komentar-form :aduan="$aduan" />
                </div>

                <!-- Lampiran -->
                <div x-show="tab === 'lampiran'">
                    @php
                        $lampiranFiles = collect(json_decode($aduan->lampiran));
                    @endphp

                    @if ($lampiranFiles->count())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($lampiranFiles as $file)
                                @php
                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                    $fileUrl = asset('storage/' . $file);
                                @endphp

                                <a href="{{ $fileUrl }}" target="_blank" class="block  p-2 rounded shadow text-sm hover:ring-2 ring-blue-400 transition">
                                    @if ($isImage)
                                        <img src="{{ $fileUrl }}" alt="Lampiran" class="w-full h-40 object-cover rounded">
                                    @else
                                        <span class="w-20 h-20 flex items-center justify-center rounded">
                                        <svg class="w-12 h-12 block" viewBox="-4 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M25.6686 26.0962C25.1812 26.2401 24.4656 26.2563 23.6984 26.145C22.875 26.0256 22.0351 25.7739 21.2096 25.403C22.6817 25.1888 23.8237 25.2548 24.8005 25.6009C25.0319 25.6829 25.412 25.9021 25.6686 26.0962ZM17.4552 24.7459C17.3953 24.7622 17.3363 24.7776 17.2776 24.7939C16.8815 24.9017 16.4961 25.0069 16.1247 25.1005L15.6239 25.2275C14.6165 25.4824 13.5865 25.7428 12.5692 26.0529C12.9558 25.1206 13.315 24.178 13.6667 23.2564C13.9271 22.5742 14.193 21.8773 14.468 21.1894C14.6075 21.4198 14.7531 21.6503 14.9046 21.8814C15.5948 22.9326 16.4624 23.9045 17.4552 24.7459ZM14.8927 14.2326C14.958 15.383 14.7098 16.4897 14.3457 17.5514C13.8972 16.2386 13.6882 14.7889 14.2489 13.6185C14.3927 13.3185 14.5105 13.1581 14.5869 13.0744C14.7049 13.2566 14.8601 13.6642 14.8927 14.2326ZM9.63347 28.8054C9.38148 29.2562 9.12426 29.6782 8.86063 30.0767C8.22442 31.0355 7.18393 32.0621 6.64941 32.0621C6.59681 32.0621 6.53316 32.0536 6.44015 31.9554C6.38028 31.8926 6.37069 31.8476 6.37359 31.7862C6.39161 31.4337 6.85867 30.8059 7.53527 30.2238C8.14939 29.6957 8.84352 29.2262 9.63347 28.8054ZM27.3706 26.1461C27.2889 24.9719 25.3123 24.2186 25.2928 24.2116C24.5287 23.9407 23.6986 23.8091 22.7552 23.8091C21.7453 23.8091 20.6565 23.9552 19.2582 24.2819C18.014 23.3999 16.9392 22.2957 16.1362 21.0733C15.7816 20.5332 15.4628 19.9941 15.1849 19.4675C15.8633 17.8454 16.4742 16.1013 16.3632 14.1479C16.2737 12.5816 15.5674 11.5295 14.6069 11.5295C13.948 11.5295 13.3807 12.0175 12.9194 12.9813C12.0965 14.6987 12.3128 16.8962 13.562 19.5184C13.1121 20.5751 12.6941 21.6706 12.2895 22.7311C11.7861 24.0498 11.2674 25.4103 10.6828 26.7045C9.04334 27.3532 7.69648 28.1399 6.57402 29.1057C5.8387 29.7373 4.95223 30.7028 4.90163 31.7107C4.87693 32.1854 5.03969 32.6207 5.37044 32.9695C5.72183 33.3398 6.16329 33.5348 6.6487 33.5354C8.25189 33.5354 9.79489 31.3327 10.0876 30.8909C10.6767 30.0029 11.2281 29.0124 11.7684 27.8699C13.1292 27.3781 14.5794 27.011 15.985 26.6562L16.4884 26.5283C16.8668 26.4321 17.2601 26.3257 17.6635 26.2153C18.0904 26.0999 18.5296 25.9802 18.976 25.8665C20.4193 26.7844 21.9714 27.3831 23.4851 27.6028C24.7601 27.7883 25.8924 27.6807 26.6589 27.2811C27.3486 26.9219 27.3866 26.3676 27.3706 26.1461ZM30.4755 36.2428C30.4755 38.3932 28.5802 38.5258 28.1978 38.5301H3.74486C1.60224 38.5301 1.47322 36.6218 1.46913 36.2428L1.46884 3.75642C1.46884 1.6039 3.36763 1.4734 3.74457 1.46908H20.263L20.2718 1.4778V7.92396C20.2718 9.21763 21.0539 11.6669 24.0158 11.6669H30.4203L30.4753 11.7218L30.4755 36.2428ZM28.9572 10.1976H24.0169C21.8749 10.1976 21.7453 8.29969 21.7424 7.92417V2.95307L28.9572 10.1976ZM31.9447 36.2428V11.1157L21.7424 0.871022V0.823357H21.6936L20.8742 0H3.74491C2.44954 0 0 0.785336 0 3.75711V36.2435C0 37.5427 0.782956 40 3.74491 40H28.2001C29.4952 39.9997 31.9447 39.2143 31.9447 36.2428Z" fill="#EB5757"></path> </g></svg>
                                        </span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada lampiran.</p>
                    @endif
                </div>



                <!-- Lokasi -->
                <div x-show="tab === 'lokasi'">
                    <p class="text-gray-700">{{ $aduan->lokasi }}</p>
                </div>
            </div>
        </div>

    </article>
</div>
