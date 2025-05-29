<div class="">

    <div class="mb-6 flex flex-wrap md:flex-nowrap gap-4">

        <!-- Search -->
        <div class="relative w-full md:w-1/2">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z"/>
                </svg>
            </span>
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Cari aduan..."
                class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-800 focus:border-indigo-800 transition"
            />
        </div>

        <!-- Kategori -->
        <div class="w-full md:w-1/6">
            <select wire:model.live="filterKategori"
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-800 focus:border-indigo-800 transition">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <!-- OPD -->
        <div class="w-full md:w-1/6">
            <select wire:model.live="filterOpd"
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-800 focus:border-indigo-800 transition">
                <option value="">Semua OPD</option>
                @foreach($opds as $opd)
                    <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Status -->
        <div class="w-full md:w-1/6">
            <select wire:model.live="filterStatus"
                    class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-800 focus:border-indigo-800 transition">
                <option value="">Semua Status</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Diproses">Diproses</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>
    </div>


    <div wire:loading.delay wire:target="search,filterKategori,filterOpd,filterStatus"class="flex justify-center items-center h-20 text-gray-500 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" class="h-20 w-20">
            <circle fill="#404185" stroke="#404185" stroke-width="2" r="15" cx="40" cy="100">
                <animate attributeName="opacity" calcMode="spline" dur="0.6" values="1;0;1;" keySplines=".5 0 .5 1;.5 0 .5 1"
                        repeatCount="indefinite" begin="-.4"/>
            </circle>
            <circle fill="#404185" stroke="#404185" stroke-width="2" r="15" cx="100" cy="100">
                <animate attributeName="opacity" calcMode="spline" dur="0.6" values="1;0;1;" keySplines=".5 0 .5 1;.5 0 .5 1"
                        repeatCount="indefinite" begin="-.2"/>
            </circle>
            <circle fill="#404185" stroke="#404185" stroke-width="2" r="15" cx="160" cy="100">
                <animate attributeName="opacity" calcMode="spline" dur="0.6" values="1;0;1;" keySplines=".5 0 .5 1;.5 0 .5 1"
                        repeatCount="indefinite" begin="0"/>
            </circle>
        </svg>
    </div>


    <div id="aduan-section" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($aduans as $aduan)
                <a href="{{ route('aduans.show', $aduan->slug) }}" wire:navigate
                    class="border-3 rounded-lg shadow p-4 flex flex-col h-full
        transform transition-transform duration-300 ease-in-out hover:scale-105
                        {{ $aduan->status == 'Selesai' ? 'border-green-500 hover:shadow-[0_0_15px_#22c55e]' :
                        ($aduan->status == 'Diproses' ? 'border-yellow-400 hover:shadow-[0_0_15px_#facc15]' :
                        'border-gray-300 hover:shadow-[0_0_15px_#a9a9a9]') }}">
                
                <div class="pb-3"> 
                    <h2 class="text-lg font-semibold mb-2">{{ $aduan->judul }}</h2>
                    <p class="text-sm text-gray-700 mb-2 line-clamp-3">{{ $aduan->isi }}</p>
                </div>
                
                <div class="mt-auto">
                    <div class="mt-auto pb-2 flex items-center justify-between">
                        <div class="flex items-center text-md text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-1" viewBox="0 0 448 512">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                            </svg>
                            <span>{{ $aduan->nama }}</span>
                        </div>
                        <p class="text-sm">
                            {{ $aduan->created_at->format('d M Y H:i') }} WIB   
                        </p>
                    </div>

                    <div class="mt-auto p-1 flex items-center justify-between bg-gray-900/5">
                        <span class="text-black text-xs font-semibold truncate max-w-[70%]">
                            {{ implode(', ', $aduan->kategoris->pluck('nama_kategori')->toArray()) }}
                        </span>
                        <span class="text-xs px-2 py-1 bg-gray-200 rounded font-semibold
                        {{ $aduan->status == 'Selesai' ? 'bg-green-500 text-white' : ($aduan->status == 'Diproses' ? 'bg-yellow-200 text-yellow-950' : 'bg-gray-200 text-gray-800') }}">
                            {{ $aduan->status }}
                        </span>
                    </div>
                </div>

            </a>
        @empty
            <p class="col-span-3 text-center text-gray-500">Tidak ada aduan ditemukan.</p>
        @endforelse

    </div>

    <div class="mt-4">
        {{ $aduans->links() }}
    </div>

 

</div>


