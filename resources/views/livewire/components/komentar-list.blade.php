<div>
@forelse ($komentars as $komentar)
    <div class="p-4 mb-3 border rounded">
        <p class="text-gray-800">{{ $komentar->pesan }}</p>
        <p class="text-xs text-gray-500 mt-1">{{ $komentar->nama }} - {{ $komentar->created_at->format('d M Y H:i') }}</p>
    </div>
@empty
    <p class="text-gray-500">Belum ada komentar.</p>
@endforelse


</div>
