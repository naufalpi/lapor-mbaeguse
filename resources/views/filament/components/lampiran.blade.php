@props(['lampiran'])

<div class="mt-1 space-y-1">
    @php
        $files = $lampiran ? json_decode($lampiran, true) : [];
    @endphp

    @if ($files && count($files))
        @foreach ($files as $index => $path)
            <div class="flex items-center space-x-2">
                <a href="{{ asset('storage/' . $path) }}"
                   target="_blank"
                   class="inline-flex items-center text-sm text-primary-600 hover:text-primary-800 underline">
                    📎 Lampiran {{ $index + 1 }}
                </a>
                @if(Str::endsWith($path, ['.jpg', '.jpeg', '.png', '.gif']))
                    <img src="{{ asset('storage/' . $path) }}"
                         alt="Lampiran {{ $index + 1 }}"
                         class="rounded border w-16 h-16 object-cover">
                @endif
            </div>
        @endforeach
    @else
        <span class="text-gray-700">-</span>
    @endif
</div>
