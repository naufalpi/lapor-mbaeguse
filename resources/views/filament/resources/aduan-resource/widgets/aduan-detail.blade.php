@php
    $aduan = $getRecord();
    $lampiran = is_array($aduan->lampiran) ? $aduan->lampiran : json_decode($aduan->lampiran, true);
@endphp

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $aduan->judul }}

            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Nomor Tiket: 
                <span class="font-mono text-blue-600">{{ $aduan->nomor_tiket }}</span>
                <button
                    type="button"
                    x-data="{ copied: false }"
                    @click="
                        navigator.clipboard.writeText('{{ $aduan->nomor_tiket }}');
                        copied = true;
                        setTimeout(() => copied = false, 2000);
                    "
                    class="ml-2 text-xs px-2 py-1 bg-gray-100 hover:bg-gray-200 rounded border text-gray-600 relative"
                >
                    <span x-show="!copied">Copy</span>
                    <span x-show="copied" class="text-green-600">Copied!</span>
                </button>


            </p>
        </div>
       
    </div>

    <!-- Grid Utama -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Kiri (2/3) -->
        <div class="md:col-span-2 space-y-6">
            <div>
                <h3 class="font-semibold text-gray-900 mb-2">Isi Aduan</h3>
                <p class="text-gray-700 bg-gray-50 p-4 rounded-md leading-relaxed">
                    {!! nl2br(e($aduan->isi)) !!}
                </p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900 mb-2">Lokasi</h3>
                <p class="text-gray-700">{{ $aduan->lokasi ?? '-' }}</p>
            </div>

            @if($lampiran)
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Lampiran</h3>
                    <div class="flex flex-wrap gap-4">
                        @foreach($lampiran as $path)
                            @if(Str::endsWith($path, ['.jpg','.jpeg','.png','.gif']))
                                <a href="{{ asset('storage/'.$path) }}" target="_blank">
                                    <img src="{{ asset('storage/'.$path) }}" 
                                         alt="Lampiran" 
                                         class="h-32 w-32 object-cover rounded-lg shadow border">
                                </a>
                            @else
                                <a href="{{ asset('storage/'.$path) }}" 
                                   target="_blank"
                                   class="text-blue-600 underline">
                                    📎 Download Lampiran
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Kanan (1/3) -->
        <div class="bg-white border rounded-lg  p-4 space-y-4">
            <p>
                <span class="block text-sm text-gray-500">Dibuat pada</span>
                <span class="text-gray-900">{{ $aduan->created_at->format('d M Y H:i') }}</span>
            </p>

            <p>
                <span class="block text-sm text-gray-500">Diperbarui pada</span>
                <span class="text-gray-900">{{ $aduan->updated_at->format('d M Y H:i') }}</span>
            </p>

            <p>
                <span class="block text-sm text-gray-500">OPD</span>
                <span class="text-gray-900">{{ $aduan->opd->nama ?? 'Belum didisposisikan' }}</span>
            </p>

            <p>
                <span class="block text-sm text-gray-500">Pelapor</span>
                <span class="text-gray-900">{{ $aduan->nama }}</span>
            </p>

            <p>
                <span class="block text-sm text-gray-500">Email</span>
                <span class="text-gray-900">{{ $aduan->email ?? '-' }}</span>
            </p>

            <p>
                <span class="block text-sm text-gray-500">Nomor WA</span>
                <span class="text-gray-900">{{ $aduan->nomor_wa ?? '-' }}</span>
            </p>
        </div>
    </div>
</div>
