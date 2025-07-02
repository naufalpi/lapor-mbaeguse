<div>
    @forelse ($komentars as $komentar)
        <div class="p-5 mb-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                        {{ strtoupper(substr($komentar->nama, 0, 1)) }}
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-800 leading-relaxed">
                        {{ $komentar->pesan }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $komentar->nama }} &bull; {{ $komentar->created_at->format('d M Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="p-4 bg-gray-50 border border-dashed border-gray-300 rounded-lg text-center text-sm text-gray-500">
            Belum ada komentar.
        </div>
    @endforelse
</div>
