<div class="flex gap-2">
    @php
        $files = is_array($getState()) ? $getState() : json_decode($getState(), true);
    @endphp

    @if($files)
        @foreach($files as $file)
            @if(Str::endsWith($file, ['.png', '.jpg', '.jpeg', '.gif']))
                {{-- Thumbnail gambar --}}
                <a href="{{ Storage::url($file) }}" target="_blank">
                    <img src="{{ Storage::url($file) }}" 
                         class="w-11 h-11 object-cover rounded-md border" />
                </a>
            @elseif(Str::endsWith($file, ['.pdf']))
                {{-- Icon PDF --}}
                <a href="{{ Storage::url($file) }}" 
                   target="_blank" 
                   class="flex flex-col items-center">
                    <x-heroicon-o-document-text class="w-10 h-10 text-red-500" />
                    <span class="text-xs">PDF</span>
                </a>
            @else
                {{-- Icon default untuk file lain --}}
                <a href="{{ Storage::url($file) }}" target="_blank">
                    <x-heroicon-o-document class="w-10 h-10 text-gray-500" />
                </a>
            @endif
        @endforeach
    @else
        <span class="text-gray-400">-</span>
    @endif
</div>
