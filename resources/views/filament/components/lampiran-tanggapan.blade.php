<div class="flex flex-wrap gap-2">
    @if ($getState() && is_array($getState()))
        @foreach ($getState() as $file)
            @php
                $url = \Illuminate\Support\Facades\Storage::url($file);
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            @endphp

            @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                {{-- Thumbnail gambar --}}
                <a href="{{ $url }}" target="_blank" class="block">
                    <img src="{{ $url }}" 
                         class="w-10 h-10 object-cover rounded border hover:opacity-80 transition" 
                         alt="lampiran">
                </a>
            @elseif($ext === 'pdf')
                {{-- Icon PDF --}}
                <a href="{{ $url }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-1 text-xs rounded bg-red-50 text-red-700 hover:bg-red-100 border">
                    <x-heroicon-o-document-text class="w-4 h-4" />
                    PDF
                </a>
            @elseif(in_array($ext, ['doc','docx']))
                {{-- Icon Word --}}
                <a href="{{ $url }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-1 text-xs rounded bg-blue-50 text-blue-700 hover:bg-blue-100 border">
                    <x-heroicon-o-document class="w-4 h-4" />
                    Word
                </a>
            @else
                {{-- Icon file umum --}}
                <a href="{{ $url }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-1 text-xs rounded bg-gray-50 text-gray-700 hover:bg-gray-100 border">
                    <x-heroicon-o-paper-clip class="w-4 h-4" />
                    File
                </a>
            @endif
        @endforeach
    @else
        <span class="text-gray-400 text-xs">-</span>
    @endif
</div>
