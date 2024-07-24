@props(['title', 'description', 'image', 'link', 'caption'])

<div class="max-w-sm rounded-lg overflow-hidden shadow-lg bg-white">
    {{-- @if($image)
        <img class="w-full" src="{{ $image }}" alt="{{ $title }}">
    @endif --}}
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2 border-b pb-2">{{ $title }}</div>
        <p class="text-gray-500 text-base">
            {{ $description }}
        </p>
    </div>
    <div class="px-6 py-4 flex items-center justify-end">
        <a href="{{ $link }}" class="inline-block bg-gray-800 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 py-2 px-4 rounded">
            Lihat {{ $caption }}
        </a>
    </div>
</div>