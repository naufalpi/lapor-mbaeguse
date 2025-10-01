<x-filament::section>
    <h2 class="text-xl font-semibold text-gray-800 mb-4">📌 Detail Aduan</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Info Kiri -->
        <div class="space-y-3">
            <div>
                <span class="block text-sm text-gray-500">Nomor Tiket</span>
                <span class="text-base font-medium text-gray-900">
                    {{ $record->aduan->nomor_tiket }}
                </span>
            </div>
            <div>
                <span class="block text-sm text-gray-500">Judul</span>
                <span class="text-base font-medium text-gray-900">
                    {{ $record->aduan->judul }}
                </span>
            </div>
            <div>
                <span class="block text-sm text-gray-500">Isi Aduan</span>
                <p class="text-base text-gray-800 leading-relaxed bg-gray-50 rounded-md p-3">
                    {{ $record->aduan->isi }}
                </p>
            </div>
        </div>

        <!-- Info Kanan -->
        <div class="space-y-3">
            <div>
                <span class="block text-sm text-gray-500">Status</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm
                    @if($record->aduan->status === 'Selesai') bg-green-100 text-green-700
                    @elseif($record->aduan->status === 'Ditanggapi') bg-blue-100 text-blue-700
                    @elseif($record->aduan->status === 'Diproses') bg-yellow-100 text-yellow-700
                    @else bg-gray-100 text-gray-700 @endif">
                    {{ $record->aduan->status }}
                </span>
            </div>
            <div>
                <span class="block text-sm text-gray-500">Kategori</span>
                <span class="text-base font-medium text-gray-900">
                    {{ $record->aduan->kategori ?? '-' }}
                </span>
            </div>
            <div>
                <span class="block text-sm text-gray-500">Lokasi</span>
                <span class="text-base font-medium text-gray-900">
                    {{ $record->aduan->lokasi ?? '-' }}
                </span>
            </div>
            <div>
                <span class="block text-sm text-gray-500">OPD</span>
                <span class="text-base font-medium text-gray-900">
                    {{ $record->aduan->opd->nama ?? 'Belum didisposisikan' }}
                </span>
            </div>
            <div>
                <span class="block text-sm text-gray-500">Lampiran</span>
                <x-lampiran :lampiran="$record->aduan->lampiran" />
            </div>

        </div>
    </div>
</x-filament::section>
