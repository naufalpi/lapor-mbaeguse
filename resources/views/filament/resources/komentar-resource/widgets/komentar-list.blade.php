<x-filament::section>
    <h2 class="text-xl font-semibold text-gray-800 mb-4">💬 Semua Komentar</h2>

    <div class="space-y-4">
        @forelse ($record->aduan->komentars as $komentar)
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <p class="text-sm font-semibold text-gray-800">
                            {{ $komentar->nama }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $komentar->email }}
                        </p>
                    </div>
                    <span class="text-xs text-gray-400">
                        {{ $komentar->created_at->format('d M Y H:i') }} WIB
                    </span>
                </div>
                <div class="text-sm text-gray-700 leading-relaxed">
                    {{ $komentar->pesan }}
                </div>
            </div>
        @empty
            <div class="p-4 text-center text-sm text-gray-500 bg-gray-50 border border-dashed border-gray-300 rounded-lg">
                Belum ada komentar untuk aduan ini.
            </div>
        @endforelse
    </div>
</x-filament::section>
